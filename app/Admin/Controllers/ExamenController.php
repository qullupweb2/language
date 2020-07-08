<?php

namespace App\Admin\Controllers;

use DB;
use App\Examen;
use App\ExamenCat;
use App\ExamenContainer;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Mail;

class ExamenController extends Controller
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
            ->body($this->getExamStudents($id))
			->row('<h3>Email newsletter</h3>')
			->body($this->emailNewsletter($id));
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

	public function emailNewsletter($id) {
		return view('admin.emailNewsletter', ['id' => $id, 'exam' => 1]);
	}

	public function sendEmailNewsletter() {
		switch (request()->status) {
			case 'paid':
				$users = DB::table('examen_containers')
					->join('users', 'users.id', '=', 'examen_containers.user_id')
					->select('users.email')
					->where('examen_containers.exam_id', request()->id)
					->where('examen_containers.paid', 1)
					->get();


				break;
			case 'no paid':
				$users = DB::table('examen_containers')
					->join('users', 'users.id', '=', 'examen_containers.user_id')
					->select('users.email')
					->where('examen_containers.exam_id', request()->id)
					->where('examen_containers.paid', 0)
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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Examen);


        $grid->name('Name');
        $grid->start_date('Start date');
        $grid->end_date('End date');

        $grid->filter(function($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();

            $categories = ExamenCat::all();

            foreach ($categories as $cat) {
                $fildata[$cat->id] = $cat->name;

            }

            $filter->in('cat_id')->multipleSelect($fildata);
        });

        $grid->actions(function ($actions) {

            // prepend an action.
            $actions->append('<a style="margin-left: 3px;" href="'.route('exam.clone', $actions->getKey()).'"><i class="fa fa-copy"></i></a>');

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
        $show = new Show(Examen::findOrFail($id));

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
        $form = new Form(new Examen);

        $form->select('name', 'Name')->options([
            'A 1' => 'A 1',
            'A 2' => 'A 2',
            'B 1' => 'B 1',
            'B 2' => 'B 2',
            'C 1' => 'C 1',            
            'A 1 für Teilnehmer' => 'A 1 für Teilnehmer',
            'A 2 für Teilnehmer' => 'A 2 für Teilnehmer',
            'B 1 für Teilnehmer' => 'B 1 für Teilnehmer',
            'B 2 für Teilnehmer' => 'B 2 für Teilnehmer',
            'C 1 für Teilnehmer' => 'C 1 für Teilnehmer',
            'Prüfung für Ärzte'  => 'Prüfung für Ärzte',
        ]);


        $form->datetime('start_date', 'Start date')->default(date('Y-m-d H:i:s'));
        $form->datetime('end_date', 'End date')->default(date('Y-m-d H:i:s'));

        $form->textarea('short_description', 'Short description');
        $form->ckeditor('description', 'Description');
        $form->ckeditor('description_en', 'Description EN');
        $form->ckeditor('description_ru', 'Description RU');
        $form->ckeditor('description_es', 'Description ES');
        $form->ckeditor('description_fr', 'Description FR');
        $form->ckeditor('description_tr', 'Description TR');
        $form->ckeditor('description_vi', 'Description VI');
        $form->ckeditor('description_zh', 'Description ZH');
        $form->ckeditor('description_ar', 'Description AR');
        $form->number('max_count', 'Max students count');


        return $form;
    }

    /**
     * Get students of course
     *
     * @return string
     */
    public function getExamStudents($id) {
        $clients = '<div class="box">';
        $clients.= '<table class="table table-hover">';
        $clients.= '<tr><td>First Name</td><td>Last Name</td><td>Paid</td><td>View</td></tr>';
        $contracts = ExamenContainer::where('exam_id', $id)->orderBy('status', 'desc')->get();

        foreach($contracts as $contract) {

            $client = User::find($contract->user_id);
            if($client !== null) {

			$clients.= '<tr>
							<td>'.$client->name.'</td>
							<td>'.$client->last_name.'</td>
							<td>'.(($contract->paid) ? 'yes' : 'no').'</td>
							<td><a href="/admin/users/'.$client->id.'"><i class="fa fa-eye"></i></a></td>
						</tr>';
            }

        }

        $clients.= '</table>';
        $clients.= '</div>';

        return $clients;

    }

    public function clone($id) {

        $examen = Examen::findOrFail($id);

        $new_examen = $examen->replicate();
        $new_examen->push();

        return redirect(route('examens.edit', $new_examen->id));

    }
}
