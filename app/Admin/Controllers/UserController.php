<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name', "用户名")->copyable();
            $grid->column('email', "邮箱")->copyable();
//            $grid->column('email_verified_at', "邮箱验证时间");
//            $grid->column('password', "密码");
            $grid->column('avatar',"头像");
            $grid->column('expire_at',"到期时间");
            $grid->column('used_limit',"区间内用量限制");
            $grid->column('time_limit',"时间区间限制");
            $grid->column('last_time', "最后登录时间");
            $grid->column('last_ip', "最后登录IP");
            $grid->column('super_user_id', "邀请者");
            $grid->column('invitation_code', "邀请码");
//            $grid->column('join_ip');
            $grid->column('status', "用户禁用状态");
            $grid->column('is_backup_data', "是否备份聊天数据");
            $grid->column('rate_limit', "返佣比例");
            $grid->column('created_at', "注册时间");

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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('name', "用户名");
            $show->field('email', "邮箱");
            $show->field('remember_token');
            $show->field('avatar');
            $show->field('expire_at',"到期时间");
            $show->field('used_limit',"区间内用量限制");
            $show->field('time_limit',"时间区间限制");
            $show->field('last_time');
            $show->field('last_ip');
            $show->field('join_time');
            $show->field('super_user_id');
            $show->field('invitation_code');
            $show->field('join_ip');
            $show->field('status');
            $show->field('is_backup_data');
            $show->field('rate_limit');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name', "用户名")->required();
            $form->email('email')->required();
            $form->date('expire_at',"到期时间")->required();
            $form->number('used_limit',"区间内用量限制")->default(20)->required();
            $form->number('time_limit',"时间区间限制")->required();
            $form->switch('status')->default(true);
            $form->switch('is_backup_data');
            $form->number('rate_limit')->default(20);
//            $form->text('email_verified_at');
//            $form->text('password');
//            $form->text('remember_token');
            $form->image('avatar');
//            $form->text('last_time');
//            $form->text('last_ip');
//            $form->text('join_time');
//            $form->text('super_user_id');
            $form->text('invitation_code')->required();
//            $form->display('join_ip');

        });
    }
}
