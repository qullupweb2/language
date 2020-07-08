<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->post('/contractActions', 'UserController@onContract');
    $router->post('/examActions', 'UserController@onExam');
    $router->post('/examActionsRepeatSend', 'UserController@onExamRepeatSend');
    $router->post('/examActionsAll', 'UserController@onExamActions');
    $router->post('/roomActionsAll', 'UserController@onRoomActions');
    $router->get('/examResultCancel/{id}', 'UserController@examResultCancel');
    $router->resource('categories', CategoryController::class);
    $router->resource('courses', CourseController::class);
    $router->post('/emailNewsletter', 'CourseController@sendEmailNewsletter');
    $router->post('/emailNewsletter_exam', 'ExamenController@sendEmailNewsletter');
    $router->resource('examens', ExamenController::class);
    $router->resource('examens_cats', ExamenCatController::class);
    $router->get('/courses/{id}/print', 'CourseController@print')->name('course.print');
    $router->get('/courses/{id}/exel', 'CourseController@exel')->name('course.exel');
    $router->get('/courses/{id}/clone', 'CourseController@clone')->name('course.clone');
    $router->get('/exam/{id}/clone', 'ExamenController@clone')->name('exam.clone');
    $router->resource('confirmes', ConfirmationController::class);
    $router->get('/ajax/getCourses', 'UserController@getAjaxCourses')->name('getAjaxCourses');
    $router->get('/ajax/getExams', 'UserController@getAjaxExams')->name('getAjaxExams');
    $router->get('/generateOfficial', 'HomeController@generateOfficial')->name('generateOfficial');
    $router->post('/generateOfficial', 'HomeController@generate')->name('generate');
    $router->resource('users', UserController::class);
    $router->resource('parser', ParserController::class, ['except'=>['edit','show']]);
    $router->resource('notifies', NotifyController::class, ['except'=>['edit','show','create']]);

    $router->resource('lessons', LessonController::class);
    $router->resource('tests', TestController::class);
    $router->resource('blocks', ContentController::class);
    $router->resource('pages', PageController::class);
    $router->resource('rooms', RoomController::class);
    $router->resource('extests', ExamenTestController::class);
    $router->resource('examgroups', GroupController::class);
    $router->resource('examdoctorsQuestions', ExamenDoctorController::class);
    $router->resource('examdoctorsListen', ExamenDoctorListenController::class);
    $router->resource('examdoctorsStage3', ExamenDoctorStage3Controller::class);
    $router->resource('examoral', ExamenOralController::class);
    $router->resource('events', EventController::class);


});


