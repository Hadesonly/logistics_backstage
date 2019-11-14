<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Controllers\Data;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Admin;

class DataController extends Controller
{

    public function index(Content $content)
    {

        $content->header('数据管理');
        // $content->description('统计...');
        // // table 1
        // $headers = ['Id', 'Email', 'Name', 'Company'];
        // $rows = [
        //     [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica'],
        //     [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar'],
        //     [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC'],
        //     [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
        //     [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.'],
        // ];

        // $table = new Table($headers, $rows);

        // echo $table->render();

        // // table 2
        // $headers = ['Keys', 'Values'];
        // $rows = [
        //     'name'   => 'Joe',
        //     'age'    => 25,
        //     'gender' => 'Male',
        //     'birth'  => '1989-12-05',
        // ];

        // $table = new Table($headers, $rows);

        // echo $table->render();

        // $box = new Box('Box标题', 'Box内容');

        // $box->removable();

        // $box->collapsable();

        // $box->style('info');

        // $box->solid();

        // $box->scrollable();

        // echo $box;
        $content->body(new Box('数据面板', view('chartjs')));
 

        // $content->row(function (Row $row) {

        //     $row->column(3, function (Column $column) {
        //         $column->row('用户总量');
        //         $column->row('111');
        //     });
        //     $row->column(3, function (Column $column) {
        //         $column->row('司机总量');
        //         $column->row('222');
        //     });
        //     $row->column(3, function (Column $column) {
        //         $column->row('订单总量');
        //         $column->row('333');
        //     });
        //     $row->column(3, function (Column $column) {
        //         $column->row('流水金额');
        //         $column->row('8888.88');
        //     });
        // });
        // $content
        //     ->row(Data::title())
        //     ->row(function (Row $row) {

        //         $row->column(4, function (Column $column) {
        //             $column->append(Data::environment());
        //         });

        //         $row->column(4, function (Column $column) {
        //             $column->append(Data::extensions());
        //         });

        //         $row->column(4, function (Column $column) {
        //             $column->append(Data::dependencies());
        //         });
        //     });
        return $content;
    }
}

