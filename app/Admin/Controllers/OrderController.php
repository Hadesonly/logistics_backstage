<?php

namespace App\Admin\Controllers;

use App\Models\BossOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单详情';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BossOrder);

        $grid->column('id', __('订单编号'));
        $grid->column('from_name', __('出发地'));
        $grid->column('to_name', __('终点'));
        $grid->column('price_total', __('价格'));
        $grid->column('order_time', __('订单时间'))->display(function ($order_time){
            return date("Y-m-d H:i:s",$order_time);
        });

        $grid->disableCreateButton();

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('id', '订单号');
            $filter->like('from_name', '出发地');
            $filter->like('to_name', '终点');

            $filter->expand();

        });

        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            // $actions->disableView();
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
        $show = new Show(BossOrder::findOrFail($id));
        $show->panel()
        ->style('info')
        ->title('订单信息');
        $show->field('status', __('订单状态'));
        $show->field('id', __('订单编号'));
        $show->field('order_time', __('订单时间'));
        $show->field('from_name', __('出发地'));
        $show->field('to_name', __('终点'));
        $show->field('price_total', __('价格'));
        $show->field('distance', __('订单距离'));
        $show->field('load_fee', __('装货费用'));
        $show->field('unload_fee', __('卸货费用'));
        $show->field('other_fee', __('其他费用'));
        $show->divider();
        $show->field('boss_id', __('用户id'));
        $show->field('car_count', __('用车数量'));
        $show->field('from_person_mobile', __('接货人手机号'));
        $show->field('from_person_name', __('接货人姓名'));
        $show->field('to_person_mobile', __('收货人手机号'));
        $show->field('to_person_name', __('收货人姓名'));

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
        $form = new Form(new BossOrder);

        $form->number('boss_id', __('Boss id'));
        $form->text('cancel_reason', __('Cancel reason'));
        $form->number('cancel_time', __('Cancel time'));
        $form->number('car_count', __('Car count'));
        $form->number('create_time', __('Create time'));
        $form->decimal('distance', __('Distance'));
        $form->text('from_adcode', __('From adcode'));
        $form->text('from_mark', __('From mark'));
        $form->text('from_name', __('From name'));
        $form->text('from_person_mobile', __('From person mobile'));
        $form->text('from_person_name', __('From person name'));
        $form->text('from_point', __('From point'));
        $form->text('goods_id', __('Goods id'));
        $form->decimal('load_fee', __('Load fee'));
        $form->number('order_time', __('Order time'));
        $form->decimal('other_fee', __('Other fee'));
        $form->decimal('price_factor', __('Price factor'));
        $form->number('status', __('Status'));
        $form->text('to_adcode', __('To adcode'));
        $form->text('to_mark', __('To mark'));
        $form->text('to_name', __('To name'));
        $form->text('to_person_mobile', __('To person mobile'));
        $form->text('to_person_name', __('To person name'));
        $form->text('to_point', __('To point'));
        $form->decimal('price_total', __('Price total'));
        $form->decimal('unload_fee', __('Unload fee'));

        return $form;
    }
}
