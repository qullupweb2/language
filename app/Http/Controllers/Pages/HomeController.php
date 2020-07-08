<?php

namespace App\Http\Controllers\Pages;

use App\Examen;
use App\ExamenContainer;
use App\Http\Services\ContractService;
use App\Http\Services\CourseService;
use App\Http\Services\ExamenService;
use App\lesson;
use App\lessonCat;
use App\Models\Course;
use App\Page;
use App\Test;
use App\Models\RoomItem;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Метод возвращает view главной страницы
     *
     * @return view(pages.home)
     */
    public function index(CourseService $courseSerivce, ExamenService $examenService, $locale = 'de') {
        app()->setLocale($locale);

        $items = Course::orderBy('start_date', 'asc')->where('start_date', '>', \Carbon\Carbon::now())->where('status', 'open')->get();

        
        $cl = [];
        
        foreach($items as $item) {
            if(!isset($cl[$item->name])) {
                $cl[$item->name] = $item;
            }
        }
 
        ksort($cl);

        return view('newpages.index', [
            'categories' => $courseSerivce->getCategories(),
            'examens' => $examenService->getCategories(),
            'items' => $cl
        ]);
    }


    public function zimmer($locale = 'de')
    {
        app()->setLocale($locale);

        $mfree = Room::where('status', 'Free')->where('type', 'Male')->first();
        $ffree = Room::where('status', 'Free')->where('type', 'Female')->first();

        //Определяем ближайшую мужскую комнату
        if($mfree !== null) {
            $mindateM = date('d.m.Y');
            $flatM = $mfree->id;
        } else {
            $mfree = RoomItem::where('type', 'Male')->latest('date_end')->limit(1)->first();
            $mindateM = $mfree->date_end->format('d.m.Y');
            $flatM = $mfree->room_id;
        }

        //Определяем ближайшую женскую комнату
        if($ffree !== null) {
            $mindateF = date('d.m.Y');
            $flatF = $ffree->id;
        } else {
            $ffree = RoomItem::where('type', 'Female')->latest('date_end')->limit(1)->first();
            $mindateF = $ffree->date_end->format('d.m.Y');
            $flatF = $ffree->room_id;
        }
        return view('newpages.zimmer', [
            'min_date_m' => $mindateM,
            'min_date_f' => $mindateF,
            'room_m' => $flatM,
            'room_f' => $flatF
        ]);
    }

    public function kontakt($locale = 'de')
    {
        app()->setLocale($locale);

        return view('newpages.contact');
    }

    public function learning($locale = 'de')
    {
        app()->setLocale($locale);

        $categories = lessonCat::all();

        return view('newpages.online-training', ['categories' => $categories]);
    }

    public function lessonsList($locale = 'de', $name = 'none')
    {
        if($name == 'none') {
            $name = $locale;
            $locale = 'de';
        }

        app()->setLocale($locale);

        $category = lessonCat::where('name', $name)->first();
        $lessons = lesson::where('category_id', $category->id)->get();

		$url = explode('/', request()->url());

		$link_register = trim_locale(app()->getLocale()) . '/deutschkurse-hannover-'.((app()->getLocale() == 'de') ? $url[4] : $url[5]).'-online/register-online';

        return view('newpages.lesson-list', ['lessons' => $lessons, 'category' => $category, 'link_register' => $link_register]);
    }

    public function lessonsItem($locale = 'de', $name = 'none', $lessonSlug = 'none')
    {
        if($lessonSlug == 'none') {
            $lessonSlug = $name;
            $name = $locale;
            $locale = 'de';
        }

        app()->setLocale($locale);

        $category = lessonCat::where('name', $name)->first();
        $lesson = lesson::where('slug', $lessonSlug)->first();
        $test = Test::find($lesson->test_id);

        return view('newpages.lesson-card', ['lesson' => $lesson, 'category' => $category, 'test' => $test]);
    }

    public function exam($locale = 'de')
    {
        app()->setLocale($locale);

        $test = Test::find(5);

        return view('newpages.exam', ['test' => $test]);
    }

    public function examItem($locale = 'de', $id = 0)
    {

        if($id == 0) {
          $id = $locale;
          $locale = 'de';
        }

        app()->setLocale($locale);
        $exam = Examen::findOrFail($id);
        $examenService = new ExamenService($exam);

        return view('newpages.sign-in-form-exam', [
            'exam' => $exam,
            'similars' => $examenService->getManyByName($exam->name),
            'rules' => config('rules'),
            'konf' => config('konf'),
        ]);
    }


    public function me($locale = 'de', ContractService $contractService)
    {
        app()->setLocale($locale);

        if(Auth::check() === false) {
            redirect()->route('home');
        }

        $contracts = $contractService->getContractsByUser(Auth::id());
        $exams = ExamenContainer::where('user_id', Auth::id())->get();
        $brons = RoomItem::where('user_id', Auth::id())->get();


        return view('newpages.my-courses', ['contracts'=>$contracts, 'exams'=> $exams, 'brons' => $brons]);
    }

    public function tests($locale = 'de')
    {
        app()->setLocale($locale);

        /*
        $testa1 = Test::where('level', 'A 1')->first();
        $testa2 = Test::where('level', 'A 2')->first();
        $testb1 = Test::where('level', 'B 1')->first();
        $testb2 = Test::where('level', 'B 2')->first();
        $testc1 = Test::where('level', 'C 1')->first();
        */

        $testa1 = Test::all()->first();
        $testa2 = Test::all()->first();
        $testb1 = Test::all()->first();
        $testb2 = Test::all()->first();
        $testc1 = Test::all()->first();

        return view('newpages.online-test', [
            'testa1'=>$testa1,
            'testa2'=>$testa2,
            'testb1'=>$testb1,
            'testb2'=>$testb2,
            'testc1'=>$testc1,
        ]);
    }

    public function page1($locale = 'de')
    {
        app()->setLocale($locale);
        $page = Page::find(1);

        return view('newpages.page', ['page'=>$page]);
    }

    public function page2($locale = 'de')
    {
        app()->setLocale($locale);
        $page = Page::find(2);

        return view('newpages.page', ['page'=>$page]);
    }

    public function page3($locale = 'de')
    {
        app()->setLocale($locale);
        $page = Page::find(3);

        return view('newpages.page', ['page'=>$page]);
    }

    public function sprachschule($locale = 'de')
    {
        app()->setLocale($locale);

        return view('newpages.sprachschule');
    }

    public function einstufungstest($locale = 'de')
    {
        app()->setLocale($locale);
		$test = Test::find(5);

        return view('newpages.einstufungstest', [ 'test' => $test]);
    }

    public function sitemap()
	{
		$pages = Page::get();
		$date = Carbon::now();

		return response()->view('sitemap', compact('pages', 'date'))->header('Content-Type', 'application/xml');
	}
}

