<?php

namespace App\Admin\Controllers;

use App\Models\trade;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TradeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\trade';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new trade);

        $grid->column('trade_id', __('流水ID'));
        $grid->column('amount', __('转入金额'));
        $grid->column('driver_mobile', __('用户手机'));
        $grid->column('pay_method', __('支付方式'));
        $grid->column('status', __('状态'));
        $grid->column('update_time', __('时间'));

        $grid->disableCreateButton();
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('trade_id', '流水ID');
            $filter->equal('driver_mobile', '用户手机');

            $filter->expand();

        });
        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            $actions->disableView();
        });

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
        $show = new Show(trade::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('amount', __('Amount'));
        $show->field('create_time', __('Create time'));
        $show->field('driver_mobile', __('Driver mobile'));
        $show->field('driver_order_id', __('Driver order id'));
        $show->field('pay_method', __('Pay method'));
        $show->field('status', __('Status'));
        $show->field('trade_id', __('Trade id'));
        $show->field('update_time', __('Update time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new trade);

        $form->decimal('amount', __('Amount'));
        $form->number('create_time', __('Create time'));
        $form->text('driver_mobile', __('Driver mobile'));
        $form->number('driver_order_id', __('Driver order id'));
        $form->text('pay_method', __('Pay method'));
        $form->number('status', __('Status'));
        $form->text('trade_id', __('Trade id'));
        $form->number('update_time', __('Update time'));

        return $form;
    }
}
