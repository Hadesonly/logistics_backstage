<?php

namespace App\Admin\Controllers;

use App\Models\DriverOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DriverOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\DriverOrder';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DriverOrder);

        $grid->column('id', __('司机单ID'));
        $grid->column('amount', __('金额（元）'));
        $grid->column('boss_order_id', __('关联的订单ID'));
        $grid->column('cancel_reason', __('取消原因'));
        $grid->column('create_time', __('创建时间'))->display(function ($create_time){
             return date("Y-m-d H:i:s",$create_time);
         });
        $grid->column('driver_id', __('司机ID'));
        $grid->column('pay_time', __('支付时间'))->display(function ($pay_time){
             return date("Y-m-d H:i:s",$pay_time);
         });
        $grid->column('status', __('状态'))->display(function ($status) {
     switch ($status) {
         case 50:
             return '已接单，未支付保证金';
             break;
         case 100:
             return '已接单,已支付保证金';
             break;
         case 200:
             return '去接货';
             break;
         case 300:
             return '已接货';
             break;
         case 400:
             return '去送货';
             break;
         case 500:
             return '已送达，等待Boss确认收货';
             break;
         case 600:
             return 'Boss已确认收货，等待Boss支付';
             break;
         case 700:
             return 'Boss已支付';
             break;
         case 800:
             return '已确认收款（完结）';
             break;
         case 10000:
             return '已取消';
             break;
        default:
             return '未知';
             break;
    }
});
        $grid->column('ton', __('过磅重量(吨)'));

        $grid->disableCreateButton();
        $grid->filter(function($filter){
            $filter->expand();
        });
        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            //$actions->disableView();
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
        $show = new Show(DriverOrder::findOrFail($id));
        $show->panel()
         ->style('info')
         ->title('司机单信息');
        $show->field('id', __('司机单ID'));
        $show->field('amount', __('金额（元）'));
        $show->field('boss_order_id', __('订单ID'));
        $show->field('cancel_reason', __('取消原因'));
        $show->field('driver_id', __('司机ID'));
        $show->divider();
        $show->field('ton', __('过磅重量（吨）'));
        $show->field('ton_pic', __('过磅单'))->image();
        $show->panel()
         ->tools(function ($tools) {
             $tools->disableEdit();
             // $tools->disableList();
             $tools->disableDelete();
         });;
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DriverOrder);

        $form->decimal('amount', __('Amount'));
        $form->number('boss_order_id', __('Boss order id'));
        $form->text('cancel_reason', __('Cancel reason'));
        $form->number('create_time', __('Create time'));
        $form->number('driver_id', __('Driver id'));
        $form->decimal('margin_amount', __('Margin amount'));
        $form->number('pay_time', __('Pay time'));
        $form->decimal('ton', __('Ton'));
        $form->text('ton_pic', __('Ton pic'));

        return $form;
    }
}
