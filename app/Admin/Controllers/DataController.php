<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Controllers\Data;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class DataController extends Controller
{
    public function index(Content $content)
    {

        $content->header('数据看板');
        $content->description('统计...');
        $content->row(function (Row $row) {

            $row->column(2, function (Column $column) {
                $column->row('用户总量');
                $column->row('111');
            });
            $row->column(2, function (Column $column) {
                $column->row('司机总量');
                $column->row('222');
            });
            $row->column(2, function (Column $column) {
                $column->row('订单总量');
                $column->row('333');
            });
            $row->column(2, function (Column $column) {
                $column->row('流水金额');
                $column->row('8888.88');
            });
        });
        $content->view('admin', ['data' => 'foo']);
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
