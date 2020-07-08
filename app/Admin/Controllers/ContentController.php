<?php

namespace App\Admin\Controllers;

use App\ContentBlock;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ContentController extends Controller
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
        $grid = new Grid(new ContentBlock);

        $grid->id('Id');
        $grid->url('Url');
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
        $show = new Show(ContentBlock::findOrFail($id));

        $show->id('Id');
        $show->slug('Url');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ContentBlock);

        $form->text('url', 'Url');
        $form->ckeditor('content', 'Content');
        $form->ckeditor('content_en', 'Content EN');
        $form->ckeditor('content_ru', 'Content RU');
        $form->ckeditor('content_es', 'Content ES');
        $form->ckeditor('content_tr', 'Content TR');
        $form->ckeditor('content_fr', 'Content FR');
        $form->ckeditor('content_vi', 'Content VI');
        $form->ckeditor('content_zh', 'Content ZH');
        $form->ckeditor('content_ar', 'Content AR');

        return $form;
    }
}
