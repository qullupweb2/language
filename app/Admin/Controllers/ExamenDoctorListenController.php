<?php

namespace App\Admin\Controllers;

use App\ExamenDoctorListen;
use App\Http\Controllers\Controller;

use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ExamenDoctorListenController extends Controller
{
	use HasResourceActions;

	/**
	 * Index interface.
	 *
	 * @param Content $content
	 * @return Content
	 */
	public function index(Content $content)
	{
		return $content
			->header('Examen Doctor')
			->description('Questions')
			->body($this->grid());
	}

	/**
	 * Edit interface.
	 *
	 * @param mixed $id
	 * @param Content $content
	 * @return Content
	 */
	public function edit($id, Content $content)
	{
		return $content
			->header('Edit')
			->description('description')
			->body($this->form()->edit($id));
	}

	/**
	 * Create interface.
	 *
	 * @param Content $content
	 * @return Content
	 */
	public function create(Content $content)
	{
		return $content
			->header('Create')
			->description('description')
			->body($this->form());
	}

	/**
	 * Make a show builder.
	 *
	 * @param mixed $id
	 * @return Show
	 */
	protected function detail($id)
	{
		$show = new Show(ExamenDoctorListen::findOrFail($id));

		$show->audio1('Audio test 2,1');
		$show->listen1('Listen test 2,1');
		$show->text1('Text 2,1');
		$show->test_a('Test Answer A (2,1)');
		$show->test_b('Test Answer B (2,1)');
		$show->test_c('Test Answer C (2,1)');
		$show->test_d('Test Answer D (2,1)');
		$show->answer('Answer');
		$show->time1('Timer 2,1');
		$show->audio2('Audio test 2,2');
		$show->listen2('Listen test 2,2');
		$show->text2('Text 2,2');
		$show->time2('Timer 2,2');

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form()
	{
		$form = new Form(new ExamenDoctorListen);

		$form->ckeditor('audio1', 'Audio test 2,1');
		$form->text('listen1', 'Audio test 2,1');
		$form->ckeditor('text1', 'Text 2,1');

		$form->text('test_a', 'Test A (2,1)');
		$form->text('test_b', 'Test B (2,1)');
		$form->text('test_c', 'Test C (2,1)');
		$form->text('test_d', 'Test D (2,1)');
		$form->select('answer', 'Answer 2,1')->options([
			'test_a' => 'A',
			'test_b' => 'B',
			'test_c' => 'C',
			'test_d' => 'D',
		]);
		$form->number('time1', 'Timer 2,1');

		$form->ckeditor('audio2', 'Audio test 2,2');
		$form->text('listen2', 'Audio test 2,2');
		$form->ckeditor('text2', 'Text 2,2');
		$form->number('time2', 'Timer 2,2');

		return $form;
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid()
	{
		$grid = new Grid(new ExamenDoctorListen);


		$grid->audio1('audio1');
		$grid->listen1('listen1');
		$grid->text1('text1');
		$grid->time1('time1');
		$grid->audio2('audio2');
		$grid->listen2('listen2');
		$grid->text2('text2');
		$grid->time2('time2');


		$grid->actions(function ($actions) {

			// prepend an action.
//			$actions->append('<a style="margin-left: 3px;" href="'.route('examdoctorsQuestions.clone', $actions->getKey()).'"><i class="fa fa-copy"></i></a>');

		});


		return $grid;
	}
}
