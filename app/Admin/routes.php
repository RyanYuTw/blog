<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('/mail', MailController::class);
    $router->get('/profile', 'ProfileController@index');
    $router->get('/district', 'DistrictController@index');
    $router->get('/district/city', 'DistrictController@getCity')->name('district.city');
    $router->get('/district/area', 'DistrictController@getArea')->name('district.area');
});
