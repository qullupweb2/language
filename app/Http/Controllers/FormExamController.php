<?php

namespace App\Http\Controllers;

use App\Examen;
use App\Http\Services\ClientService;
use App\Http\Services\ContractService;

use App\Http\Services\ExamenService;
use App\Models\Course;
use App\Rules\ValidExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Auth;

class FormExamController extends Controller
{
    /**
     * Register new client on Course
     *
     * @return json
     */
    public function register(Request $request, ClientService $clientService, ExamenService $examenService) {

        $messages = [
          'unique'    => 'The email has already been taken. Please login using your email and password.'
        ];

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:24',
            'whenStart' => ['required','max:5', new ValidExam()],
            'last_name' => 'required|max:24',
            'phone' => 'required|numeric',
            'birthDay' => 'required|max:12',
            'email' => 'unique:users|required|email',
            'country' => 'required:max:300',
            'street' => 'required:max:300',
            'city' => 'required:max:300',
            'zip' => 'required:max:300',
            'passport_number' => 'required|max:300',
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
                    'passport_number' => $request->passport_number,
                    'adress' => $request->country.','.$request->street.','.$request->city.','.$request->zip,
                ]);

            $exam = Examen::find($request->whenStart);


            $container = $examenService->createContainer($client['model']->id, $exam->id);

            
            Auth::login($client['model'], true);

            $clientService->sendRegisterConfirmationExam($container,$client);

            return \response('ok',200);

        }
    }


    /**
     * Register client on Course
     *
     * @return json
     */
    public function registerClient(Request $request, ClientService $clientService, ExamenService $examenService) {


        $validator = Validator::make($request->all(),[
            'whenStart' => ['required','max:5', new ValidExam()],
        ]);

        if ($validator->fails()) {

            return \response(json_encode($validator->errors()),400);

        } else {

            //Регистрируем и авторизируем клиента
            $client['model'] = $clientService->find(Auth::id());

            $client['model']->passport_number = $request->passport_number;
            $client['model']->save();

            $exam = Examen::find($request->whenStart);

			//$regicter_check = Examen::where('exam_id', $exam->id)->where('user_id', $client['model']->id)->first();
			//if ($regicter_check->paid == 0) return \response('no',200);

            $container = $examenService->createContainer($client['model']->id, $exam->id);

            $clientService->sendRegisterConfirmationExam($container,$client['model']);

            return \response('ok',200);

        }
    }



}
