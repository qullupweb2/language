<?php

namespace App\Http\Controllers;

use App\Http\Services\ClientService;
use App\Http\Services\ContractService;

use App\Models\Course;
use App\Models\Room;
use App\Models\RoomItem;
use App\Rules\ValidCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Auth;

class FormController extends Controller
{
    /**
     * Register new client on Course
     *
     * @return json
     */
    public function register(Request $request, ClientService $clientService, ContractService $contractService) {

        $messages = [
          'unique'    => 'The email has already been taken. Please login using your email and password.'
        ];

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:24',
            'last_name' => 'required|max:24',
            'phone' => 'required|numeric',
            'birthDay' => 'required|max:12',
            'email' => 'unique:users|required|email',
            'country' => 'required:max:300',
            'street' => 'required:max:300',
            'city' => 'required:max:300',
            'zip' => 'required:max:300',
        ], $messages);

        if ($validator->fails()) {

            return \response(json_encode($validator->errors()),400);

        } else {

            //Регистрируем и авторизируем клиента
            $client = $clientService->register([
                    'name' => $request->name,
                    'whenStart' => $request->whenStart,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'birthday' => $request->birthDay,
                    'email' => $request->email,
                    'consul' => $request->consul,
                    'passport_data' => $request->passport_data,
                    'adress' => $request->country.','.$request->street.','.$request->city.','.$request->zip,
                ]);

            

            //Создаем новый контракт на заказанный ордер
            $data = array(
                'number'=> time().'-'.$client['model']->id,
                'user_id'=>$client['model']->id,
                'status'=> 'not_paid',
                'send_sms'=> $request->send_sms_confrim == 'on' ? 1 : 0,
            );


            $contract = $contractService->create($data);

            foreach($request->whenStart as $whenStart) {
                $course = Course::find($whenStart);
            
                $dataContractItem = array(
                    'contract_id' => $contract->id,
                    'course_id' => $course->id,
                    'expired_at' => Carbon::now()->addDays(3),
                    'price'=> $course->price
                );

                $contractService->addItemToContract($dataContractItem);
            }



            

            Auth::login($client['model'], true);

			$clientService->addEventRegister($request->email, 'Register new user on the course '.$contract->items());

            $clientService->sendRegisterConfirmation($contract, $client);
			if (!empty($request->input('send_sms_confrim')) && $request->input('send_sms_confrim') == 'on') $clientService->sendSms($request->phone, __('sms_messages.course_confirmation'));

            return \response('ok',200);

        }
    }


    /**
     * Register client on Course
     *
     * @return json
     */
    public function registerClient(Request $request, ClientService $clientService,ContractService $contractService) {

        $validator = Validator::make($request->all(),[
            'whenStart' => ['required','max:5'],
        ]);

        if ($validator->fails()) {

            return \response(json_encode($validator->errors()),400);

        } else {

            //Регистрируем и авторизируем клиента
            $client['model'] = $clientService->find(Auth::id());
			$clientService->updateNeedconfirmed(Auth::user(), $request->consul);

            //Создаем новый контракт на заказанный ордер
            $data = array(
                'number'=> time().'-'.$client['model']->id,
                'user_id'=>$client['model']->id,
                'status'=> 'not_paid',
				'send_sms'=> $request->send_sms_confrim == 'on' ? 1 : 0,
            );

            $contract = $contractService->create($data);

            foreach($request->whenStart as $whenStart) {
                $course = Course::find($whenStart);
            
                $dataContractItem = array(
                    'contract_id' => $contract->id,
                    'course_id' => $course->id,
                    'expired_at' => Carbon::now()->addDays(3),
                    'price'=> $course->price
                );

                $contractService->addItemToContract($dataContractItem);
            }

            $clientService->sendRegisterConfirmation($contract, $client);
			if (!empty($request->input('send_sms_confrim')) && $request->input('send_sms_confrim') == 'on') $clientService->sendSms($client['model']->phone, __('sms_messages.course_confirmation'));

            return \response('ok',200);

        }
    }

    public function registerRoom(Request $request, ClientService $clientService) {
        $messages = [
          'unique'    => 'The email has already been taken. Please login using your email and password.'
        ];

        $validator = Validator::make($request->all(),[
            'date_start' => 'required|max:24',
            'price' => 'required',
            'room_id' => 'required',
            'name' => 'required|max:24',
            'last_name' => 'required|max:24',
            'phone' => 'required|numeric',
            'birthDay' => 'required|max:12',
            'email' => 'unique:users|required|email',
            'country' => 'required:max:300',
            'street' => 'required:max:300',
            'city' => 'required:max:300',
            'zip' => 'required:max:300',
        ], $messages);


         //Регистрируем и авторизируем клиента
        $client = $clientService->register([
            'name' => $request->name,
            'whenStart' => $request->whenStart,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'birthday' => $request->birthDay,
            'email' => $request->email,
            'consul' => $request->consul,
            'passport_data' => $request->passport_data,
            'adress' => $request->country.','.$request->street.','.$request->city.','.$request->zip,
        ]);

        $room = Room::find($request->room_id);
        $dates = explode(' - ', $request->date_start);
        $start_date = $dates[0];
        $end_date = $dates[1];


        $data = array(
            'room_id'=> $request->room_id,
            'price'=> $request->price,
            'type'=> $room->type,
            'user_id'=>$client['model']->id,
            'date_start' => $start_date,
            'date_end' => $end_date,
            'status'=> 'not_paid',
        );

        $roomItem = RoomItem::create($data);

        Auth::login($client['model'], true);

        return \response('ok',200);

    }

    public function registerClientRoom(Request $reques, ClientService $clientServicet) {
        $validator = Validator::make($request->all(),[
            'date_start' => 'required',
            'price' => 'required',
            'room_id' => 'required',
        ]);

        $client = $clientService->find(Auth::id());

        $room = Room::find($request->room_id);
        $dates = explode(' - ', $request->date_start);
        $start_date = $dates[0];
        $end_date = $dates[1];

        $data = array(
            'room_id'=> $request->room_id,
            'price'=> $request->price,
            'type'=> $room->type,
            'user_id'=>$client->id,
            'date_start' => $start_date,
            'date_end' => $end_date,
            'status'=> 'not_paid',
        );

        $roomItem = RoomItem::create($data);

        return \response('ok',200);

    }



}
