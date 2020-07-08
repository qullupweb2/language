<?php

namespace App\Admin\Controllers;

use App\lesson;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class LessonController extends Controller
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
        $grid = new Grid(new lesson);

        $grid->id('Id');
        $grid->title('Title');
        $grid->description('Description');

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
        $show = new Show(lesson::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->title_en('Title en');
        $show->title_ru('Title ru');
        $show->title_tr('Title tr');
        $show->title_es('Title es');
        $show->title_fr('Title fr');
        $show->title_vi('Title vi');
        $show->title_zh('Title zh');
        $show->title_ar('Title ar');
        $show->description('Description');
        $show->description_en('Description en');
        $show->description_ru('Description ru');
        $show->description_tr('Description tr');
        $show->description_es('Description es');
        $show->description_fr('Description fr');
        $show->description_vi('Description vi');
        $show->description_zh('Description zh');
        $show->description_ar('Description ar');
        $show->category_id('Category id');
        $show->video_html('Video html');
        $show->lection_html('Lection html');
        $show->test_id('Test id');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new lesson);

        $form->text('title', 'Title');
        $form->text('img_cdn_url', 'Cdn url image');
        $form->text('title_en', 'Title en');
        $form->text('title_ru', 'Title ru');
        $form->text('title_tr', 'Title tr');
        $form->text('title_es', 'Title es');
        $form->text('title_fr', 'Title fr');
        $form->text('title_vi', 'Title vi');
        $form->text('title_zh', 'Title zh');
        $form->text('title_ar', 'Title ar');
        $form->ckeditor('description', 'Description');
        $form->ckeditor('description_en', 'Description en');
        $form->ckeditor('description_ru', 'Description ru');
        $form->ckeditor('description_tr', 'Description tr');
        $form->ckeditor('description_es', 'Description es');
        $form->ckeditor('description_fr', 'Description fr');
        $form->ckeditor('description_vi', 'Description vi');
        $form->ckeditor('description_zh', 'Description zh');
        $form->ckeditor('description_ar', 'Description ar');
        $form->number('category_id', 'Category id');
        $form->textarea('video_html', 'Video html');
        $form->ckeditor('lection_html', 'Lection html');
        $form->number('test_id', 'Test id');

        return $form;
    }
}
