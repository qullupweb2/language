<?php

namespace App\Http\Controllers\Pages;

use App\Examen;
use App\ExamenContainer;
use App\Http\Services\ExamenService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Contract;
use App\User;

class ExamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ExamenService $examenService, $id)
    {
        $exam = $examenService->find($id);

        return view('examen.show', [
            'exam' => $exam,
            'similars' => $examenService->getManyByName($exam->name),
            'rules' => config('rules'),
            'konf' => config('konf'),
        ]);

    }

    public function exams() {

        $exams = ExamenContainer::where('user_id', Auth::id())->get();

        return view('examen.exams', ['exams'=>$exams]);

    }

    public function test() {
        $contracts = Contract::all();

        foreach($contracts as $contract) {

            $user = User::find($contract->user_id);

            if($user === null) {
                continue;
            }

            if($user->document_index == null) {
                $user->document_index = $contract->index.',';
            } else {
                if (strripos($user->document_index, $contract->index) === false) {
                    $user->document_index = $user->document_index.$contract->index.',';
                } 
            }

            $user->save();
        }

        

        return 'ok';
    }
}
