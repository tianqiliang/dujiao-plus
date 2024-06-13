<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Coupon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CouponController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Coupon(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('discount');
            $grid->column('is_use');
            $grid->column('is_open');
            $grid->column('coupon');
            $grid->column('ret');
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
        return Show::make($id, new Coupon(), function (Show $show) {
            $show->field('id');
            $show->field('discount');
            $show->field('is_use');
            $show->field('is_open');
            $show->field('coupon');
            $show->field('ret');
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
        return Form::make(new Coupon(), function (Form $form) {
            $form->display('id');
            $form->text('discount');
            $form->text('is_use');
            $form->text('is_open');
            $form->text('coupon');
            $form->text('ret');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
