<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Message;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MessageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Message(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_id');
            $grid->column('session_id');
            $grid->column('role_id');
            $grid->column('model');
            $grid->column('chat_id');
            $grid->column('message_id');
            $grid->column('role');
            $grid->column('content');
            $grid->column('ip');
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
        return Show::make($id, new Message(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('session_id');
            $show->field('role_id');
            $show->field('model');
            $show->field('chat_id');
            $show->field('message_id');
            $show->field('role');
            $show->field('content');
            $show->field('ip');
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
        return Form::make(new Message(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('session_id');
            $form->text('role_id');
            $form->text('model');
            $form->text('chat_id');
            $form->text('message_id');
            $form->text('role');
            $form->text('content');
            $form->text('ip');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
