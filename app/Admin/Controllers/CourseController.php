<?php

namespace App\Admin\Controllers;

use DB;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractItem;
use App\Models\Course;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\params\CallbackParam;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArrayValueSpecial;
use Mail;

class CourseController extends Controller
{
    use HasResourceActions;


    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id))
            ->row('<h3>List of students</h3>')
            ->body($this->getCourseStudents($id))
			->row('<h3>Email newsletter</h3>')
			->body($this->emailNewsletter($id));
    }

    /**
     * Get students of course
     *
     * @return string
     */
    public function getCourseStudents($id) {
        $clients = '<div class="box">';
        $clients.= '<table class="table table-hover">';
        $clients.= '<tr><td>First Name</td><td>Last Name</td><td>Email</td><td>Status</td><td>View</td></tr>';
        $contracts = ContractItem::where('course_id', $id)->get();


        foreach($contracts as $contract) {

            $client = User::find($contract->contract()->user_id);
            if($client !== null && $contract->contract()->status !== 'break') {

                $clients.= '<tr><td>'.$client->name.'</td><td>'.$client->last_name.'</td><td>'.$client->email.'</td><td>'.$contract->contract()->status.'</td><td><a href="/admin/users/'.$client->id.'"><i class="fa fa-eye"></i></a></td></tr>';

            }

        }

        $clients.= '</table>';
        $clients.= '<p style="padding:10px"> <a target="_blank" href="/admin/courses/'.$id.'/exel">Download xlsx</a></p>';
        $clients.= '</div>';

        return $clients;

    }

    public function emailNewsletter($id) {
		return view('admin.emailNewsletter', ['id' => $id, 'exam' => 0]);
	}

	public function sendEmailNewsletter() {
		switch (request()->status) {
			case 'paid':
				$users = DB::table('contract_items')
					->join('contracts', 'contracts.id', '=', 'contract_items.contract_id')
					->join('users', 'users.id', '=', 'contracts.user_id')
					->select('users.email')
					->where('contract_items.course_id', request()->id)
					->where(function ($query) {
						$query->where('contracts.status', 'paid')
							->orWhere('contracts.status', 'prepaid')
							->orWhere('contracts.status', 'cash_paid')
							->orWhere('contracts.status', 'cash_pre_paid');
					})
					->get();


				break;
			case 'no paid':
				$users = DB::table('contract_items')
					->join('contracts', 'contracts.id', '=', 'contract_items.contract_id')
					->join('users', 'users.id', '=', 'contracts.user_id')
					->select('users.email')
					->where('contract_items.course_id', request()->id)
					->where(function ($query) {
						$query->where('contracts.status', 'not_paid')
							->orWhere('contracts.status', 'soft_break')
							->orWhere('contracts.status', 'break');
					})
					->get();

				break;
			default:
				return redirect(route('courses.show', request()->id));
		}

		foreach ($users as $user) {
			$to_title = request()->title;
			$to_email = $user->email;
			//$to_email = 'shandstas@gmail.com';
			$to_text = request()->text;

			Mail::send([], [],  function ($message) use ($to_title, $to_text, $to_email) {
				$message->to($to_email)->subject($to_title)->setBody($to_text, 'text/html');
			});
		}

		return redirect()->back();
	}
    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Course);

        $grid->model()->orderBy('start_date', 'asc');

        $grid->category_id('Category')->display(function($id) {
            return Category::find($id)->name ?? null;
        });
        $grid->name('Name');

        $grid->id('Students count')->display(function ($id) {

            $contracts = ContractItem::where('course_id', $id)->get();

            $count = 0;
            foreach($contracts as $contract) {

                $client = User::find($contract->contract()->user_id);
                if($client !== null && $contract->contract()->status !== 'break' && $contract->contract()->status !== 'soft_break' && $contract->contract()->status !== 'not_paid') {
                    $count++;
                }

            }

            return "<span>$count</span>";
            
        });

        $grid->status('Status');

        $grid->start_date('Start date');
        $grid->end_date('End date');
        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();


            $categories = Category::all();


            foreach ($categories as $cat) {
                $fildata[$cat->id] = $cat->name;

            }

            $filter->in('category_id')->multipleSelect($fildata);
            $filter->like('name', 'Name');








        });

        $grid->actions(function ($actions) {

            // append an action.
            $actions->append('<a target="_blank" href="'.route('course.print', $actions->getKey()).'"><i class="fa fa-print"></i></a>');
            // prepend an action.
            $actions->append('<a style="margin-left: 3px;" href="'.route('course.clone', $actions->getKey()).'"><i class="fa fa-copy"></i></a>');

        });






        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Course::findOrFail($id));

        $show->category_id('Category');
        $show->name('Name');
        $show->start_date('Start date');
        $show->end_date('End date');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Course);

        
        $form->select('name', 'Name')->options([
            'A 1.1' => 'A 1.1',
            'A 1.2' => 'A 1.2',
            'A 2.1' => 'A 2.1',
            'A 2.2' => 'A 2.2',
            'B 1.1' => 'B 1.1',
            'B 1.2' => 'B 1.2',
            'B 2.1' => 'B 2.1',
            'B 2.2' => 'B 2.2',
            'C1-TestDaf' => 'C1TestDaf',
            'Deutschkurs für Ärzte' => 'Deutschkurs für Ärzte',
        ]);
        $form->select('category_id', 'Category')
        ->options(function() {

            $items = array();
            $categories = Category::all();

            foreach ($categories as $cat) {

                $items[$cat->id] = $cat->name;

            }

            return $items;


        });
        
        $form->select('status', 'Status')->options([
            'open' => 'open',
            'closed' => 'closed'
        ]);

        $form->number('duration', 'Duration, weeks');
        $form->text('book', 'Book')->default('Aspekte Neu ');
        $form->number('lessons_count', 'Hours count')->default(18);
        $form->text('how_often', 'Course schedule')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_ru', 'Course schedule RU')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_en', 'Course schedule EN')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_es', 'Course schedule ES')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_fr', 'Course schedule FR')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_tr', 'Course schedule TR')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_vi', 'Course schedule VI')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_zh', 'Course schedule ZH')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often_ar', 'Course schedule AR')->default('Fr.: 9 bis 11:45 Uhr');
        $form->text('how_often2', 'Course schedule 2')->default('Fr.: 9 bis 11:45 Uhr');


        $form->datetime('start_date', 'Start date')->default(date('Y-m-d H:i:s'));
        $form->datetime('end_date', 'End date')->default(date('Y-m-d H:i:s'));


        return $form;
    }


    public function print($id)
    {
        $course = Course::findOrFail($id);

        $contracts = ContractItem::where('course_id', $id)->get();
        $students = array();

        foreach($contracts as $contract) {
            $client = User::find($contract->contract()->user_id);
            array_push($students, $client);
        }

        return view('admin.coursePrint', ['course'=>$course, 'students'=>$students]);
    }

    public function clone($id) {

        $course = Course::findOrFail($id);

        $new_course = $course->replicate();
        $new_course->push();

        return redirect(route('courses.edit', $new_course->id));

    }

    public function exel($id) {

        define('SPECIAL_ARRAY_TYPE', CellSetterArrayValueSpecial::class);

        $course = Course::findOrFail($id);
        $clients = [];
        $clients_email = [];
        $indexes = [];

        $contracts = ContractItem::where('course_id', $id)->get();

        $index = 0;
        foreach($contracts as $contract) {

            $client = User::find($contract->contract()->user_id);
            if($client !== null && $contract->contract()->status !== 'break' && $contract->contract()->status !== 'not_paid') {
                $index++;
                if($contract->contract()->status == 'cash_pre_paid' || $contract->contract()->status == 'prepaid') { $addl = '*'; } else { $addl = ''; }
                array_push($clients, $client->name.' '.$client->last_name.$addl);
				array_push($clients_email, $client->email);
                array_push($indexes, $index);
            }

        }

        $params = [
            '{course_name}' => $course->name.' '.Carbon::parse($course->start_date)->format('d.m.Y H:i').' - '.Carbon::parse($course->end_date)->format('d.m.Y H:i'),
            '[name]' => new ExcelParam(SPECIAL_ARRAY_TYPE, $clients),
            '[email]' => new ExcelParam(SPECIAL_ARRAY_TYPE, $clients_email),
            '[index]' => new ExcelParam(SPECIAL_ARRAY_TYPE, $indexes),
        ];


        if(file_exists('./list'.$course->id.'.xlsx')) {
            unlink('./list'.$course->id.'.xlsx');
        }

        PhpExcelTemplator::saveToFile('./template.xlsx', './newlist'.$course->id.'.xlsx', $params);

        header('Location: /newlist'.$course->id.'.xlsx');
        exit;

    }
}
