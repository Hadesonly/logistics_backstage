<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    // $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/', 'DataController@index')->name('admin.home');
    // $router->resource('users', UserController::class);
    $router->resource('boss', BossController::class);
    $router->resource('driver', DriverController::class);
    $router->resource('order', OrderController::class);
    $router->resource('trade', TradeController::class);

});
