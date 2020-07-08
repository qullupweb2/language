<?php

namespace App\Admin\Controllers;

use App\Examen;
use App\ExamenOral;
use App\Models\ExamenTest;
use App\Http\Controllers\Controller;

use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ExamenOralController extends Controller
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
			->header('Examen Oral')
			->description('Questions')
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
		$show = new Show(ExamenOral::findOrFail($id));

		$show->ckeditor('Question');
		$show->audio('Audio');
		$show->time('Time');
		$show->order('Order');
		$show->exam_id('Exam id');

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form()
	{
		$form = new Form(new ExamenOral);

		$form->ckeditor('text', 'Question');
		$form->text('audio', 'Audio');
		$form->number('time', 'Time');
		$form->number('order', 'Order');
		$form->select('exam_id', 'Exam id')
			->options(function() {
				$items = array();
				$examens = Examen::all();

				foreach ($examens as $examen) if(strripos($examen->name, 'Teilnehmer') === false) { $items[$examen->id] = $examen->name.' | '.$examen->start_date; } 
				return $items;
			});

		return $form;
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid()
	{
		$grid = new Grid(new ExamenOral);


		$grid->audio('Audio');
		$grid->time('Time');
		$grid->order('Order');
		$grid->exam_id('Exam id');

		$grid->actions(function ($actions) {});


		return $grid;
	}
}