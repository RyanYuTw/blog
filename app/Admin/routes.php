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

    // 個人簡介
    $router->get('/profile', 'ProfileController@index');
    // 待辦事項拖拉頁面
    $router->get('/examples/drag_drop', 'DragAndDropController@index');
    // 待辦事項拖拉 API
    $router->put('/examples/drag_drop', 'DragAndDropController@statusUpdate');
    // 多層次選擇頁面-縣市區域為例
    $router->get('/examples/district', 'DistrictController@index');
    // 多層次選擇 API-取得縣市資料
    $router->get('/examples/district/city', 'DistrictController@getCity')->name('district.city');
    // 多層次選擇 API-取得區域資料
    $router->get('/examples/district/area', 'DistrictController@getArea')->name('district.area');
    // 影像裁切頁面
    $router->get('/examples/image_crop', 'ImageCropController@index');
    // 影像裁切 API
    $router->put('/examples/image_crop', 'ImageCropController@imageCrop');
    //資料表格搜尋頁面
    $router->get('/examples/data_table', 'DataTableController@index');
    $router->post('/examples/data_table', 'DataTableController@getData');

    // 郵件管理
    $router->resource('/examples/mail', MailController::class);

});
