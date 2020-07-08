<?php

namespace App\Http\Controllers\Pages;

use App\ExamenCat;
use App\Http\Services\ExamenService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamCatController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExamenService $examenSerivce, $id)
    {
        return view('pages.category', [
            'category' => ExamenCat::find($id),
            'courses' => [],
            'exams' => $examenSerivce->getByCategory($id),
        ]);
    }
}
