<?php

namespace App\Admin\Controllers;

use App\Models\PdfLineLog;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class ConfirmationController extends Controller
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
        $grid = new Grid(new PdfLineLog);

        $grid->created_at('Created at');
        $grid->document('Document');
        $grid->id('Id');
        $grid->status('Status');
        $grid->updated_at('Updated at');

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
        $show = new Show(PdfLineLog::findOrFail($id));

        $show->created_at('Created at');
        $show->document('Document');
        $show->id('Id');
        $show->status('Status');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PdfLineLog);


        $form->embeds('document', function ($form) {

            $form->number('Price')->rules('required');
            $form->text('Name')->rules('required');
            $form->text('Familienname')->rules('required');
            $form->text('Course')->rules('required');

        });

        return $form;
    }

    /**
     * Generate break document
     *
     * @return void
     */
    public function store(Request $request) {

        $data = [
            'course'=> $request->document['Course'],
            'price'=>$request->document['Price'],
            'name'=>$request->document['Name'],
            'lastname'=>$request->document['Familienname'],
        ];

        return view('admin.break',$data);

    }
}
