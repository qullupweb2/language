<?php

namespace App\Admin\Controllers;

use App\Test;
use App\Models\QuestionGroup;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TestController extends Controller
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
            ->body($this->form($id)->edit($id));
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
        $grid = new Grid(new Test);

        $grid->id('Id');
        $grid->name('Name');
        $grid->level('Level');

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
        $show = new Show(Test::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->level('Level');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {
        $form = new Form(new Test);

        $form->text('name', 'Name');
        $form->text('level', 'Level');

        if($id !== null) {
            $questions = Test::find($id)->value;
        } else {
            $questions = [];
        }

        $groups = QuestionGroup::all();

        $form->html(view('admin.questions',['questions'=> $questions, 'groups' => $groups]), 'Questions');

        return $form;
    }

    public function update($id)
    {

        $test = Test::findOrFail($id);

        $list = array_filter(request('list'));

        if(count($list['question']) > 0) {

            foreach ($list['question'] as $key => $q) {
                $questions[$key]['question'] = $q;
                $questions[$key]['a'] = $list['a'][$key];
                $questions[$key]['b'] = $list['b'][$key];
                $questions[$key]['c'] = $list['c'][$key];
                $questions[$key]['d'] = $list['d'][$key];
                $questions[$key]['answer'] = $list['answer'][$key];


                $questions[$key]['continiues'] = $list['continiues'][$key] ?? "off";
  
                
            }
        } else {
            $questions = [];
        }

        if($questions[0]['question'] == null) {
            unset($questions[0]);
        }

        $data = request()->validate([
            'name' => 'required|max:80',
            'level' => 'required|max:80',
        ]);

        if(request('name')) {
            $test->name = request('name');
        }
        if(request('level')) {
            $test->level = request('level');
        }

        $test->value = $questions;
        $test->save();

        return redirect()->back();

    }

    public function store()
    {

        $test = new Test();

        $list = array_filter(request('list'));

        if(count($list['question']) > 0) {
            foreach ($list['question'] as $key => $q) {
                $questions[$key]['question'] = $q;
                $questions[$key]['a'] = $list['a'][$key];
                $questions[$key]['b'] = $list['b'][$key];
                $questions[$key]['c'] = $list['c'][$key];
                $questions[$key]['d'] = $list['d'][$key];
                $questions[$key]['answer'] = $list['answer'][$key];
            }
        } else {
            $questions = [];
        }

        if($questions[0]['question'] == null) {
            unset($questions[0]);
        }

        $data = request()->validate([
            'name' => 'required|max:80',
            'level' => 'required|max:80',
        ]);

        if(request('name')) {
            $test->name = request('name');
        }
        if(request('level')) {
            $test->level = request('level');
        }

        $test->value = $questions;
        $test->save();

        return redirect()->route('tests.index');

    }
}
