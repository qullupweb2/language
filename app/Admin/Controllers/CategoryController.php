<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CategoryController extends Controller
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
        $grid = new Grid(new Category);

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
        $show = new Show(Category::findOrFail($id));

        $show->id('Id');
        $show->name('Category name');
        $show->max_count('Max students count');
        $show->description('Description');
        $show->price_description('Price description');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);

        $form->text('name', 'Name');

        $form->embeds('short_description', 'Short description', function ($form) {

            $form->text('how_often', 'How often?');
            $form->text('duration', 'Duration, weeks')->default('4-6 weeks');

        });

		$form->ckeditor('desc_view', 'Description view DE');
		$form->ckeditor('desc_view_en', 'Description view EN');
		$form->ckeditor('desc_view_ru', 'Description view RU');
		$form->ckeditor('desc_view_es', 'Description view ES');
		$form->ckeditor('desc_view_tr', 'Description view TR');
		$form->ckeditor('desc_view_fr', 'Description view FR');
		$form->ckeditor('desc_view_vi', 'Description view VI');
		$form->ckeditor('desc_view_zh', 'Description view ZH');
		$form->ckeditor('desc_view_ar', 'Description view AR');

        $form->ckeditor('course_desc_de', 'Description course DE');
        $form->ckeditor('course_desc_en', 'Description course EN');
        $form->ckeditor('course_desc_ru', 'Description course RU');
        $form->ckeditor('course_desc_es', 'Description course ES');
		$form->ckeditor('course_desc_tr', 'Description course TR');
        $form->ckeditor('course_desc_fr', 'Description course FR');
        $form->ckeditor('course_desc_vi', 'Description course VI');
		$form->ckeditor('course_desc_zh', 'Description course ZH');
		$form->ckeditor('course_desc_ar', 'Description course AR');


        $form->ckeditor('description_de', 'Description DE');
        $form->ckeditor('price_description', 'Price description DE');
        $form->ckeditor('description_en', 'Description EN');
        $form->ckeditor('price_description_en', 'Price description EN');
        $form->ckeditor('description_ru', 'Description RU');
        $form->ckeditor('price_description_ru', 'Price description RU');
        $form->ckeditor('description_es', 'Description ES');
        $form->ckeditor('price_description_es', 'Price description ES');
        $form->ckeditor('description_zh', 'Description ZH');
        $form->ckeditor('price_description_zh', 'Price description ZH');
        $form->ckeditor('description_fr', 'Description FR');
        $form->ckeditor('price_description_fr', 'Price description FR');
        $form->ckeditor('description_vi', 'Description VI');
        $form->ckeditor('price_description_vi', 'Price description VI');
        $form->ckeditor('description_tr', 'Description TR');
        $form->ckeditor('price_description_tr', 'Price description TR');
        $form->ckeditor('description_ar', 'Description AR');
        $form->ckeditor('price_description_ar', 'Price description AR');

        if(request()->path() == 'admin/categories/5/edit') {
			$form->ckeditor('desc_view_test_li', 'Description view DE TestDaf');
			$form->ckeditor('desc_view_test_li_en', 'Description view EN TestDaf');
			$form->ckeditor('desc_view_test_li_ru', 'Description view RU TestDaf');
			$form->ckeditor('desc_view_test_li_es', 'Description view ES TestDaf');
			$form->ckeditor('desc_view_test_li_tr', 'Description view TR TestDaf');
			$form->ckeditor('desc_view_test_li_fr', 'Description view FR TestDaf');
			$form->ckeditor('desc_view_test_li_vi', 'Description view VI TestDaf');
			$form->ckeditor('desc_view_test_li_zh', 'Description view ZH TestDaf');
			$form->ckeditor('desc_view_test_li_ar', 'Description view AR TestDaf');
		}

        $form->number('max_count', 'Max students count');

        $form->embeds('prices', 'Prices, €', function ($form) {

            $form->number('price_1', 'Price for before 4 weeks for all and between 2 and 4 weeks for students')->default(290);
            $form->number('price_2', 'Price for between 2 and 4 weeks for all, and between 1 and 2 weeks for students')->default(320);
            $form->number('price_3', 'Price for before 2 weeks for all, and 1 week for students')->default(350);

        });

        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'danger'],
        ];


        return $form;
    }
}
