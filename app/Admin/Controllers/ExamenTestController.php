<?php

namespace App\Admin\Controllers;

use App\Models\ExamenTest;
use App\ExamenOral;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Test;
use App\Examen;
use Carbon\Carbon;

class ExamenTestController extends Controller
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
            ->header('Index')
            ->description('description')
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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExamenTest);

        $grid->id('Id');
        $grid->name('Name');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ExamenTest::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->duration('Duration');
        $show->text_final('Text final');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ExamenTest);

        $form->text('name', 'Name');
        $form->number('duration', 'Duration(mins)');

        $form->select('basic_test_id', 'Basic test')
        ->options(function() {

            $items = array();
            $categories = Test::all();

            foreach ($categories as $cat) {

                $items[$cat->id] = $cat->name;

            }

            return $items;


        });

        $form->select('read_test_id', 'Read test')
        ->options(function() {

            $items = array();
            $categories = Test::all();

            foreach ($categories as $cat) {

                $items[$cat->id] = $cat->name;

            }

            return $items;


        });

        $form->select('listen_test_id', 'Listen test')
        ->options(function() {

            $items = array();
            $categories = Test::all();

            foreach ($categories as $cat) {

                $items[$cat->id] = $cat->name;

            }

            return $items;


        });

		$form->select('oral_test_id', 'Oral test')
			->options(function() {

				$items = array();
				$categories = ExamenOral::all();

				foreach ($categories as $cat) {

					$items[$cat->id] = $cat->name;

				}

				return $items;


		});

		$form->select('oral_test2_id', 'Oral test2')
			->options(function() {

				$items = array();
				$categories = ExamenOral::all();

				foreach ($categories as $cat) {

					$items[$cat->id] = $cat->name;

				}

				return $items;


		});


        $form->text('minutes', 'Minutes');
        $form->ckeditor('text_final', 'Text final');
        $form->ckeditor('text_instruction', 'Text instruction');
        $form->ckeditor('text_instruction_en', 'Text instruction EN');
        $form->ckeditor('text_instruction_ru', 'Text instruction RU');
        $form->ckeditor('text_instruction_es', 'Text instruction ES');
        $form->ckeditor('text_instruction_fr', 'Text instruction FR');
        $form->ckeditor('text_instruction_tr', 'Text instruction TR');
        $form->ckeditor('text_instruction_vi', 'Text instruction VI');
        $form->ckeditor('text_instruction_zh', 'Text instruction ZH');
        $form->ckeditor('text_instruction_ar', 'Text instruction AR');
		$form->ckeditor('text_instruction_oral', 'Text instruction oral');
		$form->ckeditor('text_instruction_oral_en', 'Text instruction oral EN');
		$form->ckeditor('text_instruction_oral_ru', 'Text instruction oral RU');
		$form->ckeditor('text_instruction_oral_es', 'Text instruction oral ES');
		$form->ckeditor('text_instruction_oral_fr', 'Text instruction oral FR');
		$form->ckeditor('text_instruction_oral_tr', 'Text instruction oral TR');
		$form->ckeditor('text_instruction_oral_vi', 'Text instruction oral VI');
		$form->ckeditor('text_instruction_oral_zh', 'Text instruction oral ZH');
		$form->ckeditor('text_instruction_oral_ar', 'Text instruction oral AR');

        $form->select('examen_id', 'Examen')
        ->options(function() {

            $items = array();
            $categories = Examen::all();

            foreach ($categories as $cat) {

                $items[$cat->id] = $cat->name.' | '.Carbon::parse($cat->start_date)->format('m.d.Y');

            }

            return $items;


        });

        $form->select('examen2_id', 'Examen 2')
        ->options(function() {

            $items = array();
            $categories = Examen::all();

            foreach ($categories as $cat) {

                $items[$cat->id] = $cat->name.' | '.Carbon::parse($cat->start_date)->format('m.d.Y');

            }

            return $items;


        });

        return $form;
    }
}
