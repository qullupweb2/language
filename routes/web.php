<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Disable register
Route::get('register', function () {
    abort(404);
});
Route::post('register', function () {
    abort(404);
});

Route::get('/', 'Pages\HomeController@index')->name('home');
Route::get('/personal', 'Pages\HomeController@me')->name('me');
Route::get('/zimmer-buchen', 'Pages\HomeController@zimmer')->name('zimmer');
Route::get('/kontakt', 'Pages\HomeController@kontakt')->name('kontakt');
Route::get('/deutsch-lernen-online-kostenlos', 'Pages\HomeController@learning')->name('deutsch-lernen-online');
Route::get('/deutsch-lernen-online-kostenlos/{category_name}', 'Pages\HomeController@lessonsList');
Route::get('/deutsch-lernen-online-kostenlos/{category_name}/{slug}', 'Pages\HomeController@lessonsItem');
Route::get('/pruefung-anmelden', 'Pages\HomeController@exam');
Route::get('/pruefung-anmelden/{id}', 'Pages\HomeController@examItem');
Route::get('/online-tests-deutschkurs-hannover', 'Pages\HomeController@tests');

Route::get('/agb', 'Pages\HomeController@page1');
Route::get('/impressum', 'Pages\HomeController@page2');
Route::get('/datenschutz', 'Pages\HomeController@page3');
Route::get('/sprachschule-hannover', 'Pages\HomeController@sprachschule');
Route::get('/einstufungstest-hannover', 'Pages\HomeController@einstufungstest');

//Categories
Route::get('/deutschkurse-hannover-{level}', 'Pages\CategoryController@a1');
Route::get('/deutschkurse-hannover-{level}/register', 'Pages\CategoryController@register');
Route::get('/deutschkurse-hannover-{level}/register-online', 'Pages\CategoryController@register_online');
Route::get('/testdaf-hannover', 'Pages\CategoryController@testdaf');
Route::get('/deutschkurs-fuer-aerzte', 'Pages\CategoryController@fuer_aerzte');


Route::get('/start_exam/{level}', 'ExamenController@start');
Route::get('/start_exam/{level}/oral', 'ExamenController@start');
Route::post('/start_exam/{level}', 'ExamenController@startForm')->name('start_form');
Route::post('/start_exam/{level}/oral', 'ExamenController@startFormOral')->name('start_form_oral');
//Route::post('/start_exam/{level}/oral', 'ExamenController@startForm')->name('start_form');
Route::get('/proccessing_exam/{level}', 'ExamenController@processingExam')->name('proccessing_exam');
Route::get('/proccessing_exam/{level}/oral', 'ExamenController@processingExamOral')->name('proccessing_exam_oral');
Route::post('/proccessing_exam/{level}', 'ExamenController@sendAnswer');
Route::post('/proccessing_exam/post_oral/send', 'ExamenController@saveAnswerOral');
Route::get('/finish_exam', 'ExamenController@finish')->name('finish_exam');
Route::get('sitemap.xml', 'Pages\HomeController@sitemap');


Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}']
], function() {
    Route::get('/', 'Pages\HomeController@index')->name('home');
    Route::get('/personal', 'Pages\HomeController@me')->name('me');
    Route::get('/zimmer-buchen', 'Pages\HomeController@zimmer')->name('zimmer');
    Route::get('/kontakt', 'Pages\HomeController@kontakt')->name('kontakt');
    Route::get('/deutsch-lernen-online-kostenlos', 'Pages\HomeController@learning')->name('deutsch-lernen-online');
    Route::get('/deutsch-lernen-online-kostenlos/{category_name}', 'Pages\HomeController@lessonsList');
    Route::get('/deutsch-lernen-online-kostenlos/{category_name}/{slug}', 'Pages\HomeController@lessonsItem');
    Route::get('/pruefung-anmelden', 'Pages\HomeController@exam');
    Route::get('/pruefung-anmelden/{id}', 'Pages\HomeController@examItem');
    Route::get('/online-tests-deutschkurs-hannover', 'Pages\HomeController@tests');

    //Categories
    Route::get('/deutschkurse-hannover-{level}', 'Pages\CategoryController@a1');
    Route::get('/deutschkurse-hannover-{level}/register', 'Pages\CategoryController@register');
	Route::get('/deutschkurse-hannover-{level}/register-online', 'Pages\CategoryController@register_online');
	Route::get('/testdaf-hannover', 'Pages\CategoryController@testdaf');
	Route::get('/deutschkurs-fuer-aerzte', 'Pages\CategoryController@fuer_aerzte');

    Route::get('/agb', 'Pages\HomeController@page1');
    Route::get('/impressum', 'Pages\HomeController@page2');
    Route::get('/datenschutz', 'Pages\HomeController@page3');
	Route::get('/sprachschule-hannover', 'Pages\HomeController@sprachschule');
	Route::get('/einstufungstest-hannover', 'Pages\HomeController@einstufungstest');

	Route::get('/start_exam/{level}', 'ExamenController@start');
	Route::get('/start_exam/{level}/oral', 'ExamenController@start');
	Route::post('/start_exam/{level}', 'ExamenController@startForm')->name('start_form');
	Route::post('/start_exam/{level}/oral', 'ExamenController@startFormOral')->name('start_form_oral');
	//Route::post('/start_exam/{level}/oral', 'ExamenController@startForm')->name('start_form');
	Route::get('/proccessing_exam/{level}', 'ExamenController@processingExam')->name('proccessing_exam');
	Route::get('/proccessing_exam/{level}/oral', 'ExamenController@processingExamOral')->name('proccessing_exam_oral');
	Route::post('/proccessing_exam/{level}', 'ExamenController@sendAnswer');
	Route::post('/proccessing_exam/post_oral/send', 'ExamenController@saveAnswerOral');
	Route::get('/finish_exam', 'ExamenController@finish')->name('finish_exam');
});




//Courses routes

Route::get('/testExel', 'Pages\HomeController@testExel');
Route::get('/category/{id}', 'Pages\CategoryController@show')->name('category');
Route::get('/course/{id}', 'Pages\CourseController@show')->name('course');
Route::get('/mycourses', 'Pages\ClientController@courses')->name('mycourses')->middleware('auth');
Route::get('/download', 'Pages\ClientController@download')->name('downloadPdf');

//Register form

Route::post('/registerForm', 'FormController@register')->name('registerForm');
Route::post('/registerFormClient', 'FormController@registerClient')->name('registerFormClient')->middleware('auth');

Route::post('/registerFormExam', 'FormExamController@register')->name('registerFormExam');
Route::post('/registerFormExamClient', 'FormExamController@registerClient')->name('registerFormExamClient')->middleware('auth');

Route::post('/registerFormRoom', 'FormController@registerRoom')->name('registerFormRoom');
Route::post('/registerFormRoomClient', 'FormController@registerRoomClient')->name('registerFormRoomClient')->middleware('auth');

//check verify
Route::get('/verify_check', 'CheckController@checkPage')->name('checkPage');
Route::post('/verify_check', 'CheckController@check');
Route::get('/break', 'CheckController@breakForm');
Route::post('/break', 'CheckController@break');


//Examens
Route::get('/exam_cat/{id}', 'Pages\ExamCatController@show')->name('examenCat');
Route::get('/exam/{id}', 'Pages\ExamController@show')->name('examen');
Route::get('/myexams', 'Pages\ExamController@exams')->name('myexams')->middleware('auth');
Route::get('/testmess', 'Pages\ExamController@test');



Route::get('/cron', '\App\Admin\Controllers\UserController@cronSendOfficial');
Route::get('/cron/nl', '\App\Admin\Controllers\UserController@CronBreakNalog');
Route::get('/cron/np', '\App\Admin\Controllers\UserController@cronSendNotPaid');