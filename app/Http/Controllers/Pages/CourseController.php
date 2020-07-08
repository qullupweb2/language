<?php

namespace App\Http\Controllers\Pages;

use App\Http\Services\CourseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CourseService $courseSerivce)
    {
        return view('course.index', [
           'courses' => $courseSerivce->all(), 
           
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CourseService $courseSerivce, $id)
    {

        $array_lang = ['en', 'ru', 'de','es', 'zh', 'fr', 'vi', 'ar'];
        $detect_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        if(in_array($detect_lang, $array_lang)) {
            app()->setLocale($detect_lang);
        } else {
            app()->setLocale('en');
        }

        $course = $courseSerivce->find($id);


        if($request->type == 'acceptNext') {
            $combineContracts = true;
        } else {
            $combineContracts = false;
        }

        $next1 = $courseSerivce->getNextLevel($course->name);

        if($next1 !== null) {
            $next2 = $courseSerivce->getNextLevel($next1->name);
        } else {
            $next2 = null;
        }
        


        if($next1 !== null) {
            $next1Courses = $courseSerivce->getManyByName($next1->name);
        } else {
            $next1Courses = null;
        }

        if($next2 !== null) {
            $next2Courses = $courseSerivce->getManyByName($next2->name);
        } else {
            $next2Courses = null;
        }


        return view('course.show', [
            'course' => $course,
            'category' => $courseSerivce->getCategory($id),
            'similars' => $courseSerivce->getManyByName($course->name),
            'next1Courses' => $next1Courses,
            'next2Courses' => $next2Courses,
            'rules' => config('rules'),
            'konf' => config('konf'),
            'textprice' => config('textprice'),
            'combine' => $combineContracts,
        ]);

    }

    /**
     * Returns categories of courses
     *
     * @return Array(Category)
     */
    public function getCategories(CourseService $courseSerivce) {

        return view('course.categories', [
            'categories' => $courseSerivce->getCategories()
        ]);

    }



}
