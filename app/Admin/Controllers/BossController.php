<?php

namespace App\Admin\Controllers;

use App\Models\boss;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Check;

class BossController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '老板管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new boss);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('auth_status', __('认证状态'))->display(function ($auth_status) {
            switch ($auth_status) {
                case 2:
                    return '已认证';
                    break;
                case 1:
                    return '认证中';
                    break;
                case 0:
                    return '未认证';
                    break; 
                default:
                    return '未认证';
                    break;
            }
        });
        $grid->column('create_time', __('创建时间'))->display(function ($create_time){
            return date("Y-m-d H:i:s",$create_time);
        });
        // $grid->column('gender', __('Gender'));
        // $grid->column('icon', __('Icon'));
        // $grid->column('id_card_back', __('Id card back'));
        // $grid->column('id_card_front', __('Id card front'));
        $grid->column('id_card_num', __('身份证号'));
        $grid->column('mobile', __('手机号'));
        $grid->column('name', __('姓名'));
        $grid->disableCreateButton();
        // $grid->column('nick', __('Nick'));
        // $grid->column('push_id', __('Push id'));
        // $grid->column('business_license', __('Business license'));

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '姓名');
            $filter->equal('mobile', '手机号');
            $filter->equal('auth_status', '认证状态')->select([0 => '未认证', 1 => '认证中', 2 => '已认证']);

            $filter->expand();

        });

         $grid->actions(function ($actions) {

            // 去掉删除
            // $actions->disableDelete();

            // 去掉编辑
            // $actions->disableEdit();
            // $actions->add(new Check);

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
        $show = new Show(boss::findOrFail($id));
        $show->panel()
        ->style('info')
        ->title('用户基本信息');
        $show->divider();
        // $show->field('id', __('Id'));
        // $show->field('auth_status', __('Auth status'));
        // $show->field('comment', __('Comment'));
        // $show->field('create_time', __('Create time'));
        // $show->field('gender', __('Gender'));
        // $show->field('icon', __('Icon'));
        $show->field('name', __('真实姓名'));
        $show->field('id_card_num', __('身份证号'));
        $show->divider();
        $show->field('id_card_front', __('身份证正面'))->image();
        $show->field('id_card_back', __('身份证背面'))->image();
        // $show->field('mobile', __('Mobile'));
        // $show->field('nick', __('Nick'));
        // $show->field('push_id', __('Push id'));
        $show->field('business_license', __('企业认证'))->image();
        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                // $tools->disableList();
                // $tools->disableDelete();
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
        $form = new Form(new boss);
        $form->display('name', __('真实姓名'));
        $form->display('id_card_num', __('身份证号'));
        $form->divider();
        $form->display('id_card_front', __('身份证正面'))->with(function ($id_card_front) {
            return "<img src=".$id_card_front." height=\"200\" width=\"200\" />";
        });
        $form->display('id_card_back', __('身份证背面'))->with(function ($id_card_back) {
            return "<img src=".$id_card_back." height=\"200\" width=\"200\" />";
        });
        $form->display('business_license', __('企业认证'))->with(function ($business_license) {
            return "<img src=".$business_license." height=\"200\" width=\"200\" />";
        });
        $auth_status = [
            0 => '不通过',
            2 => '通过',
        ];

        $form->select('auth_status', '认证状态')->options($auth_status);
        $form->textarea('comment', '原因');

        $form->tools(function (Form\Tools $tools) {

            // 去掉`列表`按钮
            // $tools->disableList();

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();

            // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });

        $form->footer(function ($footer) {

            // 去掉`重置`按钮
            $footer->disableReset();

            // 去掉`提交`按钮
            // $footer->disableSubmit();

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });


        return $form;
    }
}
