<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 02.11.2018
 * Time: 15:49
 */

namespace App\Http\Services;


use App\Examen;
use App\Event;
use App\Mail\ClientRegisterExam;
use App\Mail\RegisterConfirmation;
use App\Support\Dates;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\ClientRegister;
use Illuminate\Support\Facades\Log;


class ClientService extends BaseService {

    public function __construct() {

        $this->model = new User;

    }

    /**
     * Register client
     *
     * @return array
     */
    public function register(array $data) {

        if(isset($data['consul'])) {
            $needconfirmed = $data['consul'] == 'on' ? 1 : 0;
        }

        $random_pass = '123456';

        $user = new User;
        $user->password = Hash::make($random_pass);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->last_name = $data['last_name'];
        $user->birthday = $data['birthday'];
        $user->phone = $data['phone'];
        $user->adress = $data['adress'];
        $user->status = $data['status'] ?? 'demo';
        $user->needconfirmed = $needconfirmed ?? false;
        $user->passport_number = $data['passport_number'] ?? null;
        $user->passport_data = $data['passport_data'] ?? null;
        $user->save();

        $data = array(
            'model' => $user,
            'password' => $random_pass
        );

        return $data;

    }

	public function updateNeedconfirmed($user, $needconfirmed) {
		if(!empty($needconfirmed)) $needconf = $needconfirmed == 'on' ? 1 : 0;

		$user->needconfirmed = $needconf ?? false;
		$user->save();
	}


    /**
     * Check confirmation of user
     *
     * @return boolean
     */
    public function checkConfirm($id) {

        $client = $this->model->find($id);

        if($client !== null) {

            if($client->status == 'Confirmed' || $client->status == 'Prepayed') {
                return true;
            }

        } else {

            if (config('app.debug')) {
                throw new Exception('Client not found(checkconfirm)');
            } else {
                abort(500);
            }

        }

    }

    /**
     * Send email confirmation to User
     *
     * @return void
     */
    public static function sendRegisterConfirmation($contract, $client) :void
    {
        $contract_items = $contract->items();
        $category = $contract_items[0]->course()->category();


        $namesCourses = CourseService::generateCoursesNames($contract_items);
        $datesCourses = CourseService::generateCoursesDates($contract_items, false);

        $price = ContractService::getContractPrice($contract);

        $client = $client['model'] ?? $client;

        //Переменные для письма подтверждения
        $maildata = array(
            'number'=> $contract->number,
            'name_courses'=> $namesCourses,
            'date_courses' => $datesCourses,
            'password'=> $client['password'] ?? null,
            'email'=> $client->email,
            'price'=> $price,
            'how_often'=> $contract_items[0]->course()->how_often,
            'birthday'=> $client->birthday,
            'cat_desc'=> $category->short_description,
        );


        Mail::to($client->email)
            ->send(new ClientRegister($maildata));

        //Mail::to($client['model']->email)
        //    ->send(new RegisterConfirmation($contract,$client['model']));
    }

    /**
     * Send email confirmation to User exam
     *
     * @return void
     */
    public static function sendRegisterConfirmationExam($container,$client) :void
    {

        $exam = Examen::find($container->exam_id);

        $password = $client['password'] ?? null;
        $client = $client['model'] ?? $client;

        //Переменные для письма подтверждения
        $maildata = array(
            'exam'=> $exam,
            'exam_name' => $exam->name,
            'exam_date' => $exam->start_date,
            'password'=> $password,
            'email'=> $client->email,
        );


        Mail::to($client->email)
            ->send(new ClientRegisterExam($maildata));

    }

    public static function addEventRegister($user_email, $event) :void
	{

		$event_add = new Event;
		$event_add->user_email = $user_email;
		$event_add->event = $event;
		$event_add->date = Carbon::now();
		$event_add->save();
	}

	/**
	 * Send email confirmation to User
	 *
	 * @return void
	 */
	public static function sendSms($phone, $message) :void
	{
		//с локального сервера не отправляем sms
		if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') return;

		$sms_data = [
			'username'  => 'webfather@mail.ru',
			'key'		=> 'AB964029-0369-A375-ED1B-C21232508CDD',
			'to'		=> $phone,
			'senderid'	=> 'Kurse DE',
			'message'	=> $message,
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api-mapper.clicksend.com/http/v2/send.php",
			CURLOPT_TIMEOUT => 30,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $sms_data
		));

		$response = curl_exec($curl);
		Log::info($response);

		curl_close($curl);
	}

    /**
     * Parse client adress
     *
     * @return array
     */
    public static function parseClientAdress($id)
    {
        $client = User::find($id);

        $adrArr = explode(',', $client->adress);

        $data['country'] = $adrArr[0] ?? 'No country';
        $data['street'] = $adrArr[1] ?? 'No street';
        $data['city'] = $adrArr[2] ?? 'No city';
        $data['zipcode'] = $adrArr[3] ?? 'No zipcode';

        return $data;
    }

}