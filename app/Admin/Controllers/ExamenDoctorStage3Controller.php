<?php

namespace App\Admin\Controllers;

use App\ExamenDoctorStage3;
use App\Http\Controllers\Controller;

use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ExamenDoctorStage3Controller extends Controller
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
			->header('Examen Doctor Stage 3')
			->description('Tasks')
			->body($this->grid());
	}

	/**
	 * Show interface.
	 *
	 * @param mixed $id
	 * @param Content $content
	 * @return Content
	 */
	public function show($id, Content $content)
	{
		return $content
			->header('Detail')
			->description('description')
			->body($this->detail($id));
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
		$show = new Show(ExamenDoctorStage3::findOrFail($id));

		$show->text('Task');
		$show->a('Test A');
		$show->b('Test B');
		$show->c('Test C');
		$show->d('Test D');
		$show->answer('Answer');
		$show->time('Time');
		$show->stage('Stage');

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form()
	{
		$form = new Form(new ExamenDoctorStage3);

		$form->ckeditor('text', 'Task');
		$form->text('a', 'Test A');
		$form->text('b', 'Test B');
		$form->text('c', 'Test C');
		$form->text('d', 'Test D');
		$form->select('answer', 'Answer')->options([
			'a' => 'A',
			'b' => 'B',
			'c' => 'C',
			'd' => 'D',
		]);

		$form->number('time', 'Time');
		$form->select('stage', 'Stage')->options([
			'1' => '1',
			'2_1' => '2,1',
			'2_2' => '2,2',
			'3' => '3',
			'4' => '4',
		]);


		return $form;
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid()
	{
		$grid = new Grid(new ExamenDoctorStage3);


		$grid->text('Task');
		$grid->a('Test A');
		$grid->b('Test B');
		$grid->c('Test C');
		$grid->d('Test D');
		$grid->answer('Answer');
		$grid->time('Time');
		$grid->stage('Stage');


		$grid->actions(function ($actions) {});


		return $grid;
	}
}
