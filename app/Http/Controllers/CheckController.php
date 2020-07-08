<?php

namespace App\Http\Controllers;

use App\Http\Services\ExamenService;
use App\Http\Services\ContractService;
use App\Models\AdminNotify;
use App\Models\Contract;
use App\Models\Course;
use App\User;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function checkPage()
    {

        return view('pages.checkVerify');

    }

    public function check(Request $request, ContractService $contractService, ExamenService $examenService)
    {
        $i = $contractService->getContractsByNumber($request->number);
        $user = $examenService->getExamByPassport($request->number);

        if($i === null && $user === null) {
            return redirect()->back()->withErrors(['message'=> 'Student with this number not found']);
        } elseif($i !== null && $user == null) {

            $client = User::find($i->user_id);
            $course = Course::find($i->items()[0]->course_id);
            $date_start = $course->start_date;

            return redirect()->back()->with(['success'=>'Student with this number found', 'name'=>$client->name,'lastname'=>$client->last_name, 'date_start'=>$date_start]);
        } else {
            return redirect()->back()->with(['success'=>'Sertificate with this number found', 'name'=>$user->name,'lastname'=>$user->last_name]);
        }
    }


    public function breakForm()
    {
        return view('pages.break');
    }

    public function break(Request $request)
    {
        if($request->hasFile('document')) {
            $file = $request->file('document');

            //Move Uploaded File
            $destinationPath = 'uploads/breaks/';
            $file->move($destinationPath, $file->getClientOriginalName());
        }

        $adminNotify = new AdminNotify();
        $adminNotify->status = 'break';
        $adminNotify->description = 'Name: '
            .request('first_name').'; Last name: '
            .request('last_name').'; Email: '
            .request('email').'; BA:'
            .request('bank_account').'; BIC:'
            .request('bic').'; Course name:'
            .request('course_name').'; Start From:'
            .request('startDate').'; Break Reason:'
            .request('reason')
        ;
        if($request->hasFile('document')) {
            $adminNotify->description .= '; Download document: <a target="_blank" href="/'.$destinationPath.$file->getClientOriginalName().'">File</a>';
        }

        $adminNotify->save();

        return redirect()->back()->with(['success'=>'Break was succefully sended']);

    }
}
