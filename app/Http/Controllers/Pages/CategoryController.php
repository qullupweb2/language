<?php

namespace App\Http\Controllers\Pages;

use App\Http\Services\CourseService;
use App\Models\Category;
use App\Models\Course;
use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show(CourseService $courseSerivce, $id)
    {
        return view('pages.category', [
            'category' => Category::find($id),
            'courses' => $courseSerivce->getByCategory($id)
        ]);
    }

    public function a1($locale = 'de', $level = 'none')
    {

        if($level == 'none') {
            $level = $locale;
            $locale = 'de';
        }

		if($level == 'fuer-aerzte') {
			abort(404);
		}

		return $this->course_card_view($locale, $level);
    }

	public function testdaf($locale = 'de') {
		return $this->course_card_view($locale, 'c1');
	}

	public function fuer_aerzte($locale = 'de') {
		return $this->course_card_view($locale, 'fuer-aerzte');
	}

	private function course_card_view($locale, $level){

		app()->setLocale($locale);
		$category = Category::where('slug', $level)->firstOrFail();

		$tests = Test::where('name', $category->name)->get();
		$test_one = Test::find(28);

		return view('newpages.course-card', [
			'tests' => $tests,
			'test_one' => $test_one,
			'category' => $category
		]);
	}

    public function register($locale = 'de', $level = 'none')
    {



        if($level == 'none') {
            $level = $locale;
            $locale = 'de';
        }

        app()->setLocale($locale);
        $category = Category::where('slug', $level)->firstOrFail();
        if($category->name == 'A1' || $category->name == 'B1' || $category->name == 'A2' || $category->name == 'B2') {
            $catname = trim(chunk_split($category->name, 1, ' '));

            if(request('type') == '1') {
                $course = Course::where('name','like', $catname.'.1')->first();
            } else {
                $course = Course::where('name','like', $catname.'.2')->first();
            }

        } else {
            $course = Course::where('category_id', $category->id)->first();
        }

        $courseSerivce = new CourseService($course);

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



        return view('newpages.sign-in-form', [
            'course' => $course,
            'category' => $category,
            'similars' => $courseSerivce->getManyByName($course->name),
            'next1Courses' => $next1Courses,
            'next2Courses' => $next2Courses,
            'rules' => config('rules'),
            'konf' => config('konf'),
            'textprice' => config('textprice'),
        ]);


    }

    public function register_online($locale = 'de', $level = 'none')
    {


        if($level == 'none') {
            $level = $locale;
            $locale = 'de';
        }

        app()->setLocale($locale);
        $category = Category::where('slug', $level)->firstOrFail();

        $course = Course::where('category_id', $category->id)->first();


        $courseSerivce = new CourseService($course);

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



        return view('newpages.sign-in-form', [
            'course' => $course,
            'category' => $category,
            'similars' => $courseSerivce->getManyByName($course->name),
            'next1Courses' => $next1Courses,
            'next2Courses' => $next2Courses,
            'rules' => config('rules'),
            'konf' => config('konf'),
            'textprice' => config('textprice'),
        ]);


    }

}
