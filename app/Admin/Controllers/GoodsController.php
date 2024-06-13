<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\BatchRestore;
use App\Admin\Actions\Post\Restore;
use App\Admin\Repositories\Good;
use App\Models\Carmi;
use App\Models\Coupon;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Good as GoodsModel;

class GoodsController extends AdminController
{


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Good(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            $grid->column('id')->sortable();
//            $grid->column('picture')->image('', 100, 100);
            $grid->column('gd_name', "商品名");
            $grid->column('gd_description', "商品说明");
            $grid->column('used_limit', "区间内使用次数限制");
            $grid->column('time_limit', "区间大小，单位 小时");
            $grid->column('day_limit', "时长 ，以天为单位");
//            $grid->column('gd_keywords');
//            $grid->column('type')
//                ->using(GoodsModel::getGoodsTypeMap())
//                ->label([
//                    GoodsModel::AUTOMATIC_DELIVERY => Admin::color()->success(),
//                    GoodsModel::MANUAL_PROCESSING => Admin::color()->info(),
//                ]);
//            $grid->column('retail_price');
            $grid->column('actual_price', "售价")->sortable();
//            $grid->column('in_stock')->display(function () {
//                // 如果为自动发货，则加载库存卡密
//                if ($this->type == GoodsModel::AUTOMATIC_DELIVERY) {
//                    return Carmi::query()->where('goods_id', $this->id)
//                        ->where('status', Carmi::STATUS_UNSOLD)
//                        ->count();
//                } else {
//                    return $this->in_stock;
//                }
//            });
            $grid->column('sales_volume', "销量");
            $grid->column('ord', "排序")->editable()->sortable();
            $grid->column('is_open', "是否启用")->switch();
            $grid->column('created_at')->sortable();
            $grid->column('updated_at');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('gd_name');
                $filter->equal('type')->select(GoodsModel::getGoodsTypeMap());
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if (request('_scope_') == admin_trans('dujiaoka.trashed')) {
                    $actions->append(new Restore(GoodsModel::class));
                }
            });
            $grid->batchActions(function (Grid\Tools\BatchActions $batch) {
                if (request('_scope_') == admin_trans('dujiaoka.trashed')) {
                    $batch->add(new BatchRestore(GoodsModel::class));
                }
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
        return Show::make($id, new Good(), function (Show $show) {
            $show->id('id');
            $show->field('gd_name');
            $show->field('gd_description');
            $show->field('gd_keywords');
            $show->field('picture')->image();
            $show->field('retail_price');
            $show->field('actual_price');
            $show->field('in_stock');
            $show->field('ord');
            $show->field('sales_volume');
            $show->field('type')->as(function ($type) {
                if ($type == GoodsModel::AUTOMATIC_DELIVERY) {
                    return admin_trans('goods.fields.automatic_delivery');
                } else {
                    return admin_trans('goods.fields.manual_processing');
                }
            });

            $show->wholesale_price_cnf()->unescape()->as(function ($wholesalePriceCnf) {
                return  "<textarea class=\"form-control field_wholesale_price_cnf _normal_\"  rows=\"10\" cols=\"30\">" . $wholesalePriceCnf . "</textarea>";
            });
            $show->other_ipu_cnf()->unescape()->as(function ($otherIpuCnf) {
                return  "<textarea class=\"form-control field_wholesale_price_cnf _normal_\"  rows=\"10\" cols=\"30\">" . $otherIpuCnf . "</textarea>";
            });
            $show->api_hook()->unescape()->as(function ($apiHook) {
                return  "<textarea class=\"form-control field_wholesale_price_cnf _normal_\"  rows=\"10\" cols=\"30\">" . $apiHook . "</textarea>";
            });;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Good(), function (Form $form) {
            $form->display('id');
            $form->text('gd_name', "商品名")->required();
            $form->text('gd_description', "商品说明")->required();
            $form->number('used_limit', "区间内使用次数限制")->required();
            $form->number('time_limit', "区间大小，单位 小时")->required();
            $form->number('day_limit', "时长 ，以天为单位")->required();
//            $form->text('gd_keywords')->required();
//            $form->image('picture')->autoUpload()->uniqueName()->help(admin_trans('goods.helps.picture'));
//            $form->radio('type')->options(GoodsModel::getGoodsTypeMap())->default(GoodsModel::AUTOMATIC_DELIVERY)->required();
//            $form->currency('retail_price')->default(0)->help(admin_trans('goods.helps.retail_price'));
            $form->currency('actual_price', "售价")->default(0)->required();
//            $form->number('in_stock')->help(admin_trans('goods.helps.in_stock'));
            $form->number('sales_volume', "销量");

//            $form->number('buy_limit_num')->help(admin_trans('goods.helps.buy_limit_num'));
//            $form->editor('buy_prompt');
            $form->editor('description', "商品描述");
//            $form->textarea('other_ipu_cnf')->help(admin_trans('goods.helps.other_ipu_cnf'));
//            $form->textarea('wholesale_price_cnf')->help(admin_trans('goods.helps.wholesale_price_cnf'));
            $form->textarea('api_hook', "回调事件");
            $form->number('ord', "排序")->default(1)->help(admin_trans('dujiaoka.ord'));
            $form->switch('is_open', "是否启用")->default(GoodsModel::STATUS_OPEN);
        });
    }
}
