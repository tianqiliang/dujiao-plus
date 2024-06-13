<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GptAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class GptAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GptAccount(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('car_name', "车队名");
            $grid->column('account_email');
            $grid->column('state');
            $grid->column('account_password');
            $grid->column('account_session');
            $grid->column('last_error');
            $grid->column('last_message_at');
            $grid->column('message_count');
            $grid->column('gpt4');
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
        return Show::make($id, new GptAccount(), function (Show $show) {
            $show->field('id');
            $show->field('car_name', "车队名");

            $show->field('account_email');
            $show->field('state');
            $show->field('account_password');
            $show->field('account_session');
            $show->field('last_error');
            $show->field('last_message_at');
            $show->field('message_count');
            $show->field('gpt4');
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
        return Form::make(new GptAccount(), function (Form $form) {
            $form->display('id');
            $form->text('account_email');
            $form->text('car_name', "车队名");
            $form->switch('state');
            $form->text('account_password');
            $form->text('account_session');
            $form->text('last_error');
            $form->text('last_message_at');
            $form->display('message_count');
            $form->switch('gpt4');

            $form->display('created_at');
            $form->display('updated_at');
            // 无论是编辑还是创建，都去拿一下session
            if ($form->isCreating() || $form->isEditing()) {

            }
        });
    }
}
