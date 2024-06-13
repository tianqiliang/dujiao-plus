<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Capital;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CapitalController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Capital(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_id');
            $grid->column('alter_mode');
            $grid->column('source_type');
            $grid->column('balance');
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
        return Show::make($id, new Capital(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('alter_mode');
            $show->field('source_type');
            $show->field('balance');
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
        return Form::make(new Capital(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('alter_mode');
            $form->text('source_type');
            $form->text('balance');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
