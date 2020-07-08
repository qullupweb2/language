<?php

namespace App\Admin\Controllers;

use App\Examen;
use App\ExamenCat;
use App\ExamenContainer;
use App\ExamenDoctorAnswer;
use App\ExamenDoctorStage3;
use App\ExamenDoctorQuestions;
use App\Http\Services\ClientService;
use App\Http\Services\ContractService;
use App\Http\Services\CourseService;
use App\Http\Services\ExamenService;
use App\Http\Services\InvoiceService;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractCustom;
use App\Models\Course;
use App\Models\RoomItem;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Notifications\InvoicePaid;
use App\Mail\RegisterConfirmation;
use App\Mail\NotPaidManager;
use Illuminate\Support\Facades\Mail;
use App\Models\AdminNotify;
use App\Models\ExamenSession;

class UserController extends Controller
{
    use HasResourceActions;

    private $curentId;

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
            ->body($this->exam_doctor($id))
            ->body($this->contracts($id))
            ->body($this->contracts_custom($id))
            ->body($this->exams($id))
            ->body($this->lives($id))
            ;
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
            ->body($this->form(false)->edit($id));
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
        $grid = new Grid(new User);
        $grid->model()->orderBy('id', 'desc');

        $grid->email('Email');
        $grid->last_name('Last Name');

        $grid->id('Course')->display(function ($id) {

            $contract = Contract::where('user_id', $id)->get()->last();

            if($contract === null) {
            	return "<span>only exam</span>";
            }

            $item = $contract->items()->last();

            if($item == null) {
                $name = 'item deleted';
            } else {
                $name = $item->course()->name;
            }
            

            return "<span>$name</span>";
            
        });

        $grid->phone('Phone');
        
        $grid->status('Status');

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('name', 'Name');
            $filter->like('email', 'Email');
            $filter->like('last_name', 'Last name');
            $filter->like('status', 'Status');
            $filter->like('contract_number', 'Contract number');
            $filter->like('document_index', 'Document index');

            

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
        $show = new Show(User::findOrFail($id));
        $this->curentId = $id;

        $show->created_at('Register at');
        $show->birthday('Birthday');
        $show->email('Email');
        $show->name('Name');
        $show->adress('Address');
        $show->last_name('Last name');
        $show->phone('Phone');
        $show->status('Status');
        $show->passport_data('Passport data(visa)');
        $show->passport_number('Passport number(exam)');
        $show->needconfirmed('Visa certificate');
        $show->balance('Overpaid EUR.');
        $show->notice('Notice');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($create = true)
    {
        $form = new Form(new User);

        $form->email('email', 'Email');

        $form->text('name', 'Name');
        $form->text('last_name', 'Last name');

        $form->text('phone', 'Phone');
        $form->text('passport_number', 'Passport number(exam)');
        $form->text('passport_data', 'Passport data(visa)');

//		$form->checkbox('needconfirmed', 'Visa certificate')
//			->options(['0' => 'no','1' => 'yes']);

		$form->switch('needconfirmed', 'Visa certificate')->states( [
			'on'  => ['value' => 1],
			'off' => ['value' => 0],
		]);

        if(!$create) {
            $form->number('balance', 'Overpaid EUR.');
        }

        
            $form->datetime('birthday', 'Birth Day')->format('DD/MM/YYYY');
        
        	$form->text('adress', 'Address')->default('Country, Street, City, Zipcode');

            $form->select('status', 'Status')
                ->options(['demo' => 'Demo','Confirmed' => 'Confirmed', 'Prepayed'=>'Prepayed', 'Cash paid'=>'Confirmed cash']);

            $categories = Category::all();

            
            $form->html(view('admin.selectLessons', ['categories'=>$categories]), 'Add student to course');

            $exams = Examen::all();

            $form->html(view('admin.selectExam', ['examens'=>$exams]), 'Add student to exam');

            $form->html(view('admin.selectContractCustom'), 'Add custom contract');

            $form->textarea('notice', 'Notice');

        return $form;
    }

    /**
     * Get invoiced by user
     *
     * @return html
     */
    public function exam_doctor($user_id) {

		$user = User::find($user_id);
		$exam_doctor = ExamenDoctorAnswer::where('user_email', $user->email)->first();

		if (!$exam_doctor) return;

		(!is_null($exam_doctor->stage1)) ? $stage1 = (array)json_decode($exam_doctor->stage1) : $stage1 = null;
		(!is_null($exam_doctor->stage2)) ? $stage2 = (array)json_decode($exam_doctor->stage2) : $stage2 = null;
		(!is_null($exam_doctor->stage2_2)) ? $stage2_2 = (array)json_decode($exam_doctor->stage2_2) : $stage2_2 = null;
		(!is_null($exam_doctor->stage3)) ? $stage3 = (array)json_decode($exam_doctor->stage3) : $stage3 = null;
		(!is_null($exam_doctor->stage4)) ? $stage4 = (array)json_decode($exam_doctor->stage4) : $stage4 = null;


		$questions = ExamenDoctorQuestions::where('stage', 1)->get();
		$questions4 = ExamenDoctorQuestions::where('stage', 4)->get();
		$question_text3 = ExamenDoctorStage3::where('stage', 3)->first();
		$question_text4 = ExamenDoctorStage3::where('stage', 4)->first();

		$questions_answer = [];
		if(isset($stage1)) foreach ($questions as $question) if(isset($stage1['question'.$question->id])) { $questions_answer[$stage1['question'.$question->id]] = $question->question; }

		$questions_answer2 = [];
		if(isset($stage4)) foreach ($questions4 as $question) if(isset($stage4['question'.$question->id])) { $questions_answer2[$stage4['question'.$question->id]] = $question->question; }

		if (isset($stage2)) $stage2['score'] = $stage2['score'] ? 'true' : 'false';
		if (isset($stage3)) $stage3['score'] = $stage3['score'] ? 'true' : 'false';

        return view('admin.exam_doctor', [ 'questions_answer' 	=> $questions_answer,
												'questions_answer2' => $questions_answer2,
												'question_text3' 	=> $question_text3,
												'question_text4' 	=> $question_text4,
												'stage2' 			=> $stage2,
												'stage2_2' 			=> $stage2_2,
												'stage3'			=> $stage3
		]);

    }


    /**
     * Get invoiced by user
     *
     * @return html
     */
    public function contracts($user_id) {



        $contracts = Contract::where('user_id', $user_id)->get();

        return view('admin.contracts')->with('contracts', $contracts);

    }

    public function contracts_custom ($user_id) {

		$contracts_custom = ContractCustom::where('user_id', $user_id)->get();

		return view('admin.contracts_custom')->with('contracts_custom', $contracts_custom);
	}

    public function lives($user_id) {



        $items = RoomItem::where('user_id', $user_id)->get();

        return view('admin.lives')->with('items', $items);

    }

    /**
     * Get invoiced by user
     *
     * @return html
     */
    public function exams($user_id) {

        $exams = ExamenContainer::where('user_id', $user_id)->get();

        return view('admin.exams')->with('exams', $exams);

    }

    /**
     * Return list courses by category for select
     *
     * @return json
     */
    public function getAjaxCourses(CourseService $courseService)
    {
        $courses = $courseService->getByCategoryAll(request('id'), false);

        $json = array();

        $i = 0;

        foreach ($courses as $course) {
            
                $json['lessons'][$i]['id'] = $course->id;
                $json['lessons'][$i]['value'] = '('.$course->name.') '.Carbon::parse($course->start_date)->format('d.m.Y H:i').' - '.Carbon::parse($course->end_date)->format('d.m.Y H:i');
                $i++;
        }

        return json_encode($json);


    }

    /**
     * Return list exams by category for select
     *
     * @return json
     */
    public function getAjaxExams(ExamenService $examenService)
    {
        $exams = $examenService->getByCategory(request('id'), false);

        $json = array();

        $i = 0;

        foreach ($exams as $exam) {
            if($exam->available) {
                $json['exams'][$i]['id'] = $exam->id;
                $json['exams'][$i]['value'] = '('.$exam->name.') '.Carbon::parse($exam->start_date)->format('d.m.Y');
            }
            $i++;
        }

        return json_encode($json);


    }


    /**
     * Store user
     *
     * @return
     */
    public function store(ClientService $clientService, ContractService $contractService, CourseService $courseService)
    {

        $data = request()->validate([
            'name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'phone' => 'required|numeric',
            'birthday' => 'required|max:12',
            'email' => 'unique:users|required|email',
            'adress' => 'required:max:300',
            'status' => 'required',
            'notice' => 'nullable'
        ]);



        $client = $clientService->register($data);

        if($client['model']->status == 'Confirmed') {
            $status = 'paid';
        } elseif($client['model']->status == 'Prepayed') {
            $status = 'prepaid';
        } elseif($client['model']->status == 'Cash paid') {
            $status = 'cash_paid';
        } else {
            $status = 'not_paid';
        }



        //Создаем новый контракт на заказанный ордер
        $data = array(
            'number'=> time().'-'.$client['model']->id,
            'user_id'=>$client['model']->id,
            'status'=> $status,
        );


        $contract = $contractService->create($data);

        $index = 0;

        foreach (array_unique(request('start_at')) as $item) {

            if($item == null) continue;

            $course = $courseService->find($item);

            $dataContractItem = array(
                'contract_id' => $contract->id,
                'course_id' => $course->id,
                'expired_at' => Carbon::now()->addDays(3),
                'price'=> request('price')[$index]
            );

            $contractItem = $contractService->addItemToContract($dataContractItem);

            $index++;
        }

        return $this->actionAfterAdd($status, $client['model'], $contract);

    }

    /**
     * Store user
     *
     * @return
     */
    public function update($id, ContractService $contractService, CourseService $courseService, ExamenService $examenService, ClientService $clientService)
    {

        $client = User::find($id);

        $client_data = request()->validate([
            'name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'phone' => 'required|numeric',
            'passport_number' => 'max:30|nullable',
            'passport_data' => 'max:30|nullable',
            'birthday' => 'required|max:12',
            'adress' => 'required:max:300',
            'status' => 'required',
            'balance' => 'nullable|numeric',
            'notice' => 'nullable'
        ]);

		$client_data['needconfirmed'] = request()->needconfirmed == 'on' ? 1 : 0;

        $client->update($client_data);


        if(request('level')[0] === null && request('exam_start') === null && request('name_custom')[0] === null) return redirect()->back();

		if(request('name_custom')[0] !== null) {
			$index = 0;

			//Создаем новый кастомный контракт на заказанный ордер
			foreach (array_unique(request('name_custom')) as $item) {

				$customContract = new ContractCustom();
				$customContract->name = request('name_custom')[$index];
				$customContract->price = request('price_custom')[$index];
				$customContract->status = request('status_custom')[$index];
				$customContract->user_id = $id;
				$customContract->save();

				$index++;
			}
		}

        if(request('level')[0] !== null) {

            //Создаем новый контракт на заказанный ордер
            $data = array(
                'number'=> time().'-'.$id,
                'user_id'=>$id,
                'status'=> 'not_paid',
            );


            $contract = $contractService->create($data);


            $index = 0;

            foreach (array_unique(request('start_at')) as $item) {

                if($item == null) continue;

                $course = $courseService->find($item);

                $dataContractItem = array(
                    'contract_id' => $contract->id,
                    'course_id' => $course->id,
                    'expired_at' => Carbon::now()->addDays(3),
                    'price'=> request('price')[$index]
                );

                $contractItem = $contractService->addItemToContract($dataContractItem);

                $index++;
            }

            return $this->actionAfterAdd('demo', $client, $contract);
        }


        if(request('exam_start') !== null) {

            $exam = Examen::find(request('exam_start'));

            $container = $examenService->createContainer($client->id, $exam->id);

            $clientService->sendRegisterConfirmationExam($container,$client);

            redirect()->back();

        }
    }

    /**
     * Do something after add user
     *
     * @return
     */
    public function actionAfterAdd($status, $client, $contract)
    {

        switch ($status) {

            case 'demo':
                ClientService::sendRegisterConfirmation($contract, $client);
                break;
            case 'cash_paid':
                $data = InvoiceService::generateConfirmed($contract, $client);
                return view('admin.confirmation', $data);

                break;
        }


    }

    /**
 * On contract form
 *
 * @return redirect
 */
    public function onContract(ContractService $contractService, InvoiceService $invoiceService)
    {
        $contract = $contractService->find(request('contract_id'));

        switch (request('action')) {
            case 'break':
                $data['price'] = request('price');
                $data['reason'] = request('reason');
                $data['bank_reqs'] = request('bank_reqs');
                $contractService->breakContract($contract, $data);
                break;

            case 'breakWithConfirm':
                $data['price'] = request('price');
                $data['reason'] = request('reason');
                $data['bank_reqs'] = request('bank_reqs');
                $invoiceService->createPdfOfficialPaid($contract);
                $contractService->breakContractPre($contract, $data);
                break;    

            case 'softBreak':
                $contract->status = 'soft_break';
                $contract->save();
                break;         
            case 'confirm':
                $contractService->confirmContract($contract);
                break;
            case 'confirmFull':
                $contract->payed = $contract->price;
                $contract->status = 'paid';
                $contract->save();
                $client = User::find($contract->user_id);
                $client->status = 'Confirmed';
                $client->save();
                $contractService->confirmContract($contract);
                break;    
            case 'sendOfficialPaid':
                if($contract->status !== 'not_paid') {
                    $contractService->sendOfficialPaid($contract);
                }
                break;            
            case 'sendOfficial':
                $contractService->sendOfficial($contract);
                $contract->sent = 1;
                $contract->save();
                break;
            case 'confirmOfParticipation':

                $data['course_name'] = request('course_name');
                $data['start_date'] = request('start_date');
                $data['end_date'] = request('end_date');

                $contractService->sendConfirmParticipation($contract, $data);
                break;

            case 'confirmOfParticipationFuture':

                $data['course_name'] = request('course_name');
                $data['start_date'] = request('start_date');
                $data['end_date'] = request('end_date');

                $contractService->sendConfirmParticipationFuture($contract, $data);
                break;    

            case 'confirmVisa':

                $data['course_name1'] = request('course_name1');
                $data['date_1'] = request('date_1');
                $data['date_2'] = request('date_2');

                $contractService->sendConfirmVisa($contract, $data);
                break;
                
            case 'confirmCash':

                $client = User::find($contract->user_id);

                if(request('payed_price') > 0) {
                    $prepaid = true;
                    $client->status = 'Cash prepaid';
                    $contract->status = 'cash_pre_paid';
                    $contract->payed = request('payed_price');
                } else {
                    $prepaid = false;
                    $client->status = 'Cash paid';
                    $contract->status = 'cash_paid';
                    $contract->payed = $contract->price;
                }

                $contract->paid_at = Carbon::now();

                $adminNotify = new AdminNotify;
                $adminNotify->status = 'success';
                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> contract '.$contract->number.' was confirmed cash';
                $adminNotify->save();
                
                
                $client->save();

                
                $contract->save();

                $data = InvoiceService::generateConfirmedCash($contract, $client, $prepaid);
                return view('admin.confirmation_print', $data);
                break;

            case 'confirmManual':

                $client = User::find($contract->user_id);

                if(request('payed_price') > 0) {
                    $prepaid = true;
                    $client->status = 'Prepayed';
                    $contract->status = 'prepaid';
                    $contract->payed = request('payed_price');
                } else {
                    $prepaid = false;
                    $client->status = 'Confirmed';
                    $contract->status = 'paid';
                    $contract->payed = $contract->price;
                }


                $contract->paid_at = Carbon::now();

                $client->save();
                $contract->save();
                $contractService->sendOfficialPaid($contract);

                //$contractService->sendOfficial($contract);
                //$invoiceService->createPdfInvoice($contract);
                

                $adminNotify = new AdminNotify;
                $adminNotify->status = 'success';
                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> contract '.$contract->number.' was confirmed manual';
                $adminNotify->save();


                
                Mail::to($client->email)->send(new RegisterConfirmation($contract,$client, true));
                break;    
        }

        return redirect()->back();
    }

    /**
     * On exam form
     *
     * @return redirect
     */
    public function onExam(ExamenService $examenService, ContractService $contractService)
    {

        $container = ExamenContainer::find(request('container_id'));
        $container->hv = request('hv');
        $container->lv = request('lv');
        $container->sa = request('sa');
        $container->ma = request('ma');
        $container->status = 'closed';
        $container->save();

        $exam = $examenService->find($container->exam_id);
        $user = User::find($container->user_id);

        $examenService->createPdfExam($exam, $user,$container->id);
        $filepath = $examenService->createPdfExamForMail($exam, $user,$container->id);
        $user->notify(new \App\Notifications\ConfirmExam($exam, $filepath));


        return view('admin.sert', ['container'=>$container, 'exam'=>$exam, 'user'=>$user]);


    }

    /**
     * On exam form
     *
     * @return redirect
     */
    public function onExamRepeatSend(ExamenService $examenService, ContractService $contractService)
    {

        $container = ExamenContainer::find(request('container_id'));

        $exam = $examenService->find($container->exam_id);
        $user = User::find($container->user_id);

        $examenService->createPdfExam($exam, $user,$container->id);
        $filepath = $examenService->createPdfExamForMail($exam, $user,$container->id);
        $user->notify(new \App\Notifications\ConfirmExam($exam, $filepath));


        return view('admin.sert', ['container'=>$container, 'exam'=>$exam, 'user'=>$user]);


    }

    public function onExamActions(ExamenService $examenService) {

    	$examContrainer = ExamenContainer::find(request('exam_contrainer_id'));

    	switch (request('action')) {

    	        case 'confirmOfExam':

                $data['exam_name'] = request('exam_name');
                $data['date'] = request('date');

                $examenService->sendConfirmExam($examContrainer, $data);
                break;

                case 'confirmPaid':

                $examenService->confirmPaid($examContrainer);
                break;

                case 'clearResults':
                $user = User::find($examContrainer->user_id);
                $examContrainer->hv_prev = 0;
                $examContrainer->lv_prev = 0;
                $examContrainer->sa_prev = 0;
                $examContrainer->user_text = " ";
                $examContrainer->save();

                $session = ExamenSession::where('user_email', $user->email)->where('exam_id', $examContrainer->exam_id)->first();
                $session->delete();

                case 'clearOral':
                $user = User::find($examContrainer->user_id);

                $sessions = ExamenSession::where('user_email', $user->email)->where('type', 'oral')->get();
                foreach ($sessions as $session) $session->delete();

				$examContrainer->update(['oral1' => null]);
                
                break;
        }

        return redirect()->back();
    }

    public function onRoomActions() {

        $item = RoomItem::find(request('item_contrainer_id'));

        switch (request('action')) {

                case 'confirmPaid':

                $item->status = 'paid';
                $item->save();
                break;
        }

        return redirect()->back();
    }


    public function cronSendOfficial(ContractService $contractService)
    {
        $contracts = Contract::where('sent', '0')->where('status','not_paid')->where('created_at','<', Carbon::now()->addDays(-3))->get();

        foreach($contracts as $contract) {



            $user = User::find($contract->user_id);
            if($user === null) continue;



            $contractService->sendOfficial($contract);
            $contract->sent = 1;
            $contract->save();
    
            
        }

        
    }

    public function cronSendNotPaid(ContractService $contractService)
    {
        $contracts = Contract::where('not_paid_sent', '0')->where('status','not_paid')->where('created_at','<', Carbon::now()->addDays(-6))->get();

        foreach($contracts as $contract) {



            $user = User::find($contract->user_id);
            if($user === null) continue;


            Mail::to('info@deutsch-kurs-hannover.com')->send(new NotPaidManager($contract->user_id));

            $contract->not_paid_sent = 1;
            $contract->save();
    
            
        }

        
    }

    

    public function CronBreakNalog(ContractService $contractService) {
        $contracts = Contract::where('updated_at','<', Carbon::now()->addDays(-30))->where('breaked', 0)->where('generated', 0)->get();

        foreach($contracts as $contract) {
            $data['price'] = $contract->price;
            $contractService->breakContractHide($contract, $data);
        }
    }

    public function examResultCancel($id) {
        $container = ExamenContainer::find($id);
        $container->status = 'pending';
        $container->save();

        return redirect()->back();
    }
}
