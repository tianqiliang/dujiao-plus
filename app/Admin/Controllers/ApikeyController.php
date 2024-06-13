<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Apikey;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ApikeyController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Apikey(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('state')->switch();
            $grid->column('last_error');
            $grid->column('error_count');
            $grid->column('last_message_at');
            $grid->column('message_count');
            $grid->column('gpt4');
            $grid->column('embedding');
            $grid->column('dalle');
            $grid->column('suspended');
            $grid->column('gpt3');
            $grid->column('tts');
            $grid->column('api');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Apikey(), function (Show $show) {
            $show->field('id');
            $show->field('state');
            $show->field('last_error');
            $show->field('error_count');
            $show->field('last_message_at');
            $show->field('message_count');
            $show->field('gpt4');
            $show->field('embedding');
            $show->field('dalle');
            $show->field('suspended');
            $show->field('gpt3');
            $show->field('tts');
            $show->field('api');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Apikey(), function (Form $form) {
            $form->display('id');
            $form->text('state');
            $form->text('last_error');
            $form->text('error_count');
            $form->text('last_message_at');
            $form->text('message_count');
            $form->text('gpt4');
            $form->text('embedding');
            $form->text('dalle');
            $form->text('suspended');
            $form->text('gpt3');
            $form->text('tts');
            $form->text('api');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
