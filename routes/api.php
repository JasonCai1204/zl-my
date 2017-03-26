<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['namespace' => 'api'], function(){

    Route::group(['domain' => 'ys.zl-my.com'], function () {

        Route::get('/doctor', function (Request $request) {
            return collect([
                'status' => 1,
                'msg' => '验证通过。'
            ]);
        })->middleware('auth:api','apiDoctor');

        // Doctor Authontication
        Route::group(['namespace' => 'Auth\ys'], function () {
            Route::post('logout', 'LogoutController@logout');
            Route::post('account/password/reset', 'ResetPasswordController@reset');
            Route::post('account/password/forget', 'ForgetPasswordController@forget');
        });

        // Profile
        Route::post('account/getProfile','DoctorController@getProfile');
        Route::post('account/modifyProfile','DoctorController@modifyProfile');

        // Order lists
        Route::post('/orders','OrderController@getDoctorOrders');

        // condition_report
        Route::get('/report','OrderController@report');


    });

    // User Authontication
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('logout', 'LogoutController@logout');
        Route::post('account/password/reset', 'ResetPasswordController@reset');
        Route::post('account/password/forget', 'ForgetPasswordController@forget');
        Route::post('test','testController@test');
    });

    // Profile
    Route::post('account/user/getProfile','UserController@getProfile');
    Route::post('account/user/modifyProfile','UserController@modifyProfile');

    // Index
    Route::get('/','WebController@index');

    // Search
    Route::get('search', 'HospitalController@search');

    // News
    Route::resource('news','NewsController');

    // Guide
    Route::get('guide','NewsController@guide');
    Route::get('loadmore','NewsController@loadMore');

    // Recommend
    Route::get('recommends','WebController@recommend');

    // Find Doctors
    Route::get('doctor/select','DoctorController@getSelect');
    Route::get('doctor','DoctorController@index');
    Route::get('doctor/detail','DoctorController@detail');

    // Find hospitals
    Route::get('hospital','HospitalController@index');
    Route::get('hospital/detail','HospitalController@detail');

    // Qa
    Route::get('support/qa',function(){
        return view('api.qa');
    });

    // About
    Route::get('about',function(){
        return view('api.about');
    });

    // Services
    Route::get('legal/terms',function(){
        return view('api.services');
    });

    // Order
    Route::post('order/postPhotos','OrderController@postPhotos');
    Route::post('orders/create','OrderController@postCreate');
    Route::resource('order','OrderController');
    Route::get('user/orders','OrderController@getUserOrders');
    Route::get('orders/judge','OrderController@judge');
    Route::put('orders/update','OrderController@updateOrders');

    // Instance
    Route::resource('instance','InstanceController');

    // SendSMS
    Route::get('service/validate/send','ValidateController@sendSMS');

    Route::get('test','WebController@test');



});




