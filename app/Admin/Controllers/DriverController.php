<?php

namespace App\Admin\Controllers;

use App\Models\driver;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DriverController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '司机管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new driver);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('姓名'));
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
        $grid->column('mobile', __('手机号'));
        $grid->column('car_type', __('车辆类型'))->display(function ($car_type) {
            switch ($car_type) {
                case 1:
                    return '单桥板车';
                    break;
                case 2:
                    return '双桥板车';
                    break;
                case 3:
                    return '单桥自卸半挂';
                    break;
                case 4:
                    return '双桥自卸半挂';
                    break; 
                case 5:
                    return '单桥罐车';
                    break; 
                case 6:
                    return '双桥罐车';
                    break;  
                default:
                    return '其他';
                    break;
            }
        });
        $grid->column('create_time', __('创建时间'))->display(function ($create_time){
            return date("Y-m-d H:i:s",$create_time);
        });

         $grid->disableCreateButton();
         $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '姓名');
            $filter->equal('mobile', '手机号');
            $filter->equal('auth_status', '认证状态')->select([0 => '未认证', 1 => '认证中', 2 => '已认证']);

            $filter->expand();

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
        $show = new Show(driver::findOrFail($id));
        $show->panel()
        ->style('info')
        ->title('用户基本信息');
        $show->divider();
        $show->field('name', __('Name'));
        $show->field('id_card_num', __('身份证号'));
        $show->field('emergency_contact_name', __('紧急联系人'));
        $show->field('emergency_contact_mobile', __('紧急联系人电话'));
        $show->divider();
        $show->field('car_type', __('车辆类型'));
        $show->field('car_num', __('车牌号码'));
        $show->divider();
        $show->field('bank_address', __('开户行'));
        $show->field('bank_num', __('银行卡号'));
        $show->divider();
        $show->field('id_card_front', __('身份证正面'))->image();
        $show->field('id_card_back', __('身份证背面'))->image();
        $show->field('driver_license', __('驾照'))->image();
        $show->field('vehicle_license', __('行驶证'))->image();
        $show->field('bank_photo', __('Bank photo'))->image();

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
        $form = new Form(new driver);

        $form->display('name', __('真实姓名'));
        $form->display('id_card_num', __('身份证号'));
        $form->display('emergency_contact_name', __('紧急联系人'));
        $form->display('emergency_contact_mobile', __('紧急联系人电话'));
    

        $form->display('car_type', __('车辆类型'));
        $form->display('car_num', __('车牌号码'));

        $form->display('id_card_front', __('身份证正面'))->with(function ($id_card_front) {
            return "<img src=".$id_card_front." height=\"200\" width=\"200\" />";
        });
        $form->display('id_card_back', __('身份证背面'))->with(function ($id_card_back) {
            return "<img src=".$id_card_back." height=\"200\" width=\"200\" />";
        });
    
        $form->display('driver_license', __('驾驶证'))->with(function ($driver_license) {
            return "<img src=".$driver_license." height=\"200\" width=\"200\" />";
        });
        $form->display('vehicle_license', __('行驶证'))->with(function ($vehicle_license) {
            return "<img src=".$vehicle_license." height=\"200\" width=\"200\" />";
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
