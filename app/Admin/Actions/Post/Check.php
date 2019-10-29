<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\boss;
use Encore\Admin\Show;
use Encore\Admin\Form;

class Check extends RowAction
{
    public $name = '审核';

    public function handle(Model $model, Request $request)
    {

        // 获取到表单中的`auth_status`值
        $request->get('auth_status');

        // 获取表单中的`comment`值
        $request->get('comment');

        // 你的审核逻辑...
        // 处理错误
        try {
            // 处理逻辑...
            switch ($auth_status) {
                case 2:
                    # 成功的推送
                     
                    break;
                case 0:
                    # 不成功的推送和短信

                    break;
                
                default:
                    return $this->response()->error('认证状态异常');
                    break;
            }

            return $this->response()->success('审核完成')->refresh();
        } catch (Exception $e) {
            return $this->response()->error('产生错误：'.$e->getMessage());
        }
    }

    public function form()
    {
		$this->text('name',__('真实姓名'));
        $this->text('id_card_num', __('身份证号'));
        $this->text('id_card_front', __('身份证正面'));
        $this->text('id_card_back', __('身份证背面'));
        $this->text('business_license', __('企业认证'));

        $auth_status = [
            0 => '不通过',
            2 => '通过',
        ];

        $this->select('auth_status', '认证状态')->options($auth_status);
        $this->textarea('comment', '原因')->rules('required');

    }

    /**
     * Make a form builder.
     *
     * @return Form
    */
    // protected function form()
    // {
    //     $form = new Form(new boss);
    //     $form->display('name', __('真实姓名'));
    //     $form->display('id_card_num', __('身份证号'));
    //     $form->divider();
    //     $form->display('id_card_back', __('Id card back'));
    //     $form->display('id_card_front', __('Id card front'));
    //     $form->display('business_license', __('Business license'));
    //     $auth_status = [
    //         0 => '不通过',
    //         2 => '通过',
    //     ];

    //     $form->select('auth_status', '认证状态')->options($auth_status);
    //     $form->textarea('comment', '原因')->rules('required');

    //     return $form;
    // }

    // public function html()
 //    {
 //        return "<a class='report-posts btn btn-sm btn-danger'><i class='fa fa-info-circle'></i>审核</a>";
 //    }

    // public function dialog()
 //    {
 //        $this->confirm('确定审核？');
 //    }

}