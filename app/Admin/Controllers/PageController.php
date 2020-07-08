<?php

namespace App\Admin\Controllers;

use App\Page;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PageController extends Controller
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
        $grid = new Grid(new Page);

        $grid->id('Id');
        $grid->slug('Slug');
        $grid->title('Title');

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
        $show = new Show(Page::findOrFail($id));

        $show->id('Id');
        $show->slug('Slug');
        $show->title('Title');
        $show->content('Content');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Page);

        $form->text('slug', 'Slug');
        $form->text('title', 'Title');
        $form->text('title_en', 'Title en');
        $form->text('title_ru', 'Title ru');
        $form->text('title_es', 'Title es');
        $form->text('title_tr', 'Title tr');
        $form->text('title_fr', 'Title fr');
        $form->text('title_vi', 'Title vi');
        $form->text('title_zh', 'Title zh');
        $form->text('title_ar', 'Title ar');
        $form->ckeditor('content', 'Content');
        $form->ckeditor('content_en', 'Content en');
        $form->ckeditor('content_ru', 'Content ru');
        $form->ckeditor('content_es', 'Content es');
        $form->ckeditor('content_tr', 'Content tr');
        $form->ckeditor('content_fr', 'Content fr');
        $form->ckeditor('content_vi', 'Content vi');
        $form->ckeditor('content_zh', 'Content zh');
        $form->ckeditor('content_ar', 'Content ar');

        return $form;
    }
}
