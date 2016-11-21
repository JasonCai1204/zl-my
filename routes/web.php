<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Doctor
//Route::group(['domain' => '{doctor}.zl-my.com'], function () {
    //
//});

// Api
//Route::group(['domain' => '{api}.zl-my.com'],  function () {
    //
//});

// CMS
Route::group(['domain' => '{cms}.zl-my.com'],  function () {

});














//Index
Route::get('/','WebController@index');

////Search
//Route::get('search', 'HospitalController@search');
//
//////Order/create
////Route::get('Order/create','WebController@create');
//
////Recommend
//Route::get('recommends','WebController@recommend');
//
////Account
//Route::get('account',function(){
//    return view('accounts.account');
//});
//
//Route::get('signin',function(){
//   return view('accounts.signin');
//});
//
//Route::get('signup',function(){
//    return view('accounts.signup');
//});
//
////Contact
//Route::get('contact',function(){
//    return view('contact');
//});
//
////Qa
//Route::get('support/qa',function(){
//    return view('qa');
//});
//
////About
//Route::get('about',function(){
//    return view('about');
//});
//
////Online Service   null
//
//// query-method
//Route::get('query-method', 'AppController@index');
//
////CMS Start
//
////City
//Route::get('city/list','CityController@list');
//Route::get('cities','CityController@cities');
//Route::resource('city','CityController');
//
////Master
//Route::get('master/list','MasterController@list');
//Route::get('master/signin','MasterController@getLogin');
//Route::post('master/signin','MasterController@postLogin');
//Route::get('master/signout','MasterController@getLogout');
//Route::get('master/profile','MasterController@profile');
//Route::put('master/profile','MasterController@changePw');
//Route::resource('master','MasterController');
//
////Hospital
//Route::get('hospital/list','HospitalController@list');
//Route::get('hospitals','HospitalController@hospitals');
Route::get('hospital/select','HospitalController@getSelect');
Route::post('hospital/select','HospitalController@postSelect');
Route::resource('hospital','HospitalController');

//Route::get('hospital',function(){
//return view('hospitals.select');
//});
//
////Type
//Route::get('type/list','TypeController@list');
//Route::resource('type','TypeController');
//
//Instance
Route::get('instance/list','InstanceController@list');
Route::get('instance/select','InstanceController@getSelect');
Route::post('instance/select','InstanceController@postSelect');
Route::get('instance/doctor/select','InstanceController@getDoctorSelect');
//Route::resource('instance','InstanceController');

Route::get('instance',function(){
   return view('instances.select');
});
//
//Doctor
//Route::get('doctor/list','DoctorController@list');

Route::get('doctor/signin','DoctorController@getLogin');
Route::post('doctor/signin','DoctorController@postLogin');
Route::get('doctor/orders','DoctorController@getOrders');
Route::get('doctor/select','DoctorController@getSelect');
Route::post('doctor/select','DoctorController@postSelect');
//Select doctor from hospital.
Route::get('doctor/hospital/select','DoctorController@getHospitalSelect');

// Select doctor from instance.

Route::get('doctor/instance/select','DoctorController@getInstanceSelect');
//Route::get('doctor/dashboard','DoctorController@dashboard');
//Route::post('doctor/dashboard','DoctorController@dashboard');
//Route::get('doctors','DoctorController@doctors');
//Route::get('doctor/{doctor}/display', 'DoctorController@display');
Route::resource('doctor','DoctorController');
//Route::get();
//
//
//Order
//Route::get('order/list','OrderController@list');
//Route::get('order/{id}/photo','OrderController@editPhoto');
//Route::post('order/{id}/photo','OrderController@addPhoto');
//Route::delete('order/{id}/photo','OrderController@deletePhoto');
//Route::get('order/{id}/report','OrderController@editReport');
//Route::put('order/{id}/report','OrderController@updatePhoto');
//Route::post('order/{id}/report/photo','OrderController@uploadReportPhoto');
Route::post('order/postPhotos','OrderController@postPhotos');
Route::get('orders/create','OrderController@getCreate');
Route::post('orders/create','OrderController@postCreate');
Route::get('order/{order}/display','OrderController@display');
Route::get('order/msg','OrderController@getMsg');
Route::resource('order','OrderController');
Route::get('test',function(){
    return view('upload');
});
//
//Route::get('order',function(){
//    return view('orders.order');
//});
//
////News
//Route::get('news/list','NewsController@list');
Route::resource('news','NewsController');
//Route::get('news',function(){
//    return view('news.news');
//});
//
//Route::get('cms', function(){
//    return '欢迎';
//});

//CMS End

