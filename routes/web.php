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


// Index
Route::get('/','WebController@index');

// Search
Route::get('search', 'HospitalController@search');

// News
Route::resource('news','NewsController');
Route::get('loadmore','NewsController@loadMore');

// Recommend
Route::get('recommends','WebController@recommend');

// Hospital
Route::get('hospital/select','HospitalController@getSelect');
Route::post('hospital/select','HospitalController@postSelect');
Route::resource('hospital','HospitalController');

// Instance
Route::get('instance/select','InstanceController@getSelect');
Route::post('instance/select','InstanceController@postSelect');
Route::get('instance/doctor/select','InstanceController@getDoctorSelect');
Route::resource('instance','InstanceController');

// Doctor
// Doctor sign in.
Route::get('doctor/signin','DoctorController@getSignin');
Route::post('doctor/signin','DoctorController@postSignin');

// Doctor sign out.
Route::get('doctor/signout','DoctorController@getSignout');

Route::get('doctor/orders','DoctorController@getOrders');
Route::get('doctor/select','DoctorController@getSelect');
Route::post('doctor/select','DoctorController@postSelect');
Route::get('doctor/password/reset','DoctorController@getReset');
Route::post('doctor/password/reset','DoctorController@postReset');
Route::get('doctor/profile','DoctorController@getProfile');
Route::get('doctor/orders','DoctorController@getOrders');
Route::get('doctor/orders/condition_report','DoctorController@getCondition_report');
// Select doctor from hospital.
Route::get('doctor/hospital/select','DoctorController@getHospitalSelect');
// Select doctor from instance.
Route::get('doctor/instance/select','DoctorController@getInstanceSelect');
Route::resource('doctor','DoctorController');

// Order
Route::post('order/postPhotos','OrderController@postPhotos');
Route::get('orders/create','OrderController@getCreate');
Route::post('orders/create','OrderController@postCreate');
Route::get('order/{order}/display','OrderController@display');
Route::get('order/msg','OrderController@getMsg');
Route::resource('order','OrderController');

// User account.
Route::resource('account','UserController@index');

// Sign in.
Route::get('signin','UserController@getSignIn');
Route::post('signin','UserController@postSignIn');

// Sign out.
Route::get('signout','UserController@signOut');

// Sign up.
Route::get('signup','UserController@getSignUp');
Route::post('signup','UserController@postSignUp');

// Profile
Route::get('account/user/profile','UserController@getProfile');
Route::post('account/user/profile','UserController@postProfile');

// Modify password
Route::get('account/password/reset','UserController@getReset');
Route::post('account/password/reset','UserController@postReset');

//  User orders
Route::get('account/user/orders','UserController@getOrders');

// Contact
Route::get('contact',function(){
    return view('users.contact');
});

// Qa
Route::get('support/qa',function(){
    return view('users.qa');
});

// About
Route::get('about',function(){
    return view('users.about');
});





// CMS
Route::group(['domain' => '{cms}.zl-my.com'],  function () {

    Route::get('/', function () {
        return view('cms.home');
    });

// city
    Route::get('cities', 'CityController@index4cms');
    Route::get('cities/create', 'CityController@create4cms');
    Route::post('cities', 'CityController@store4cms');
    Route::get('cities/{city}', 'CityController@show4cms');
    Route::put('cities/{city}', 'CityController@update4cms');
    Route::delete('cities/{city}', 'CityController@destroy4cms');

// hospital
    Route::get('hospitals', 'HospitalController@index4cms');
    Route::get('hospitals/create', 'HospitalController@create4cms');
    Route::post('hospitals', 'HospitalController@store4cms');
    Route::get('hospitals/{hospital}', 'HospitalController@show4cms');
    Route::put('hospitals/{hospital}', 'HospitalController@update4cms');
    Route::delete('hospitals/{hospital}', 'HospitalController@destroy4cms');

// doctor
    Route::get('doctors', 'DoctorController@index4cms');
    Route::get('doctors/create', 'DoctorController@create4cms');
    Route::post('doctors', 'DoctorController@store4cms');
    Route::get('doctors/{doctor}', 'DoctorController@show4cms');
    Route::put('doctors/{doctor}', 'DoctorController@update4cms');
    Route::delete('doctors/{doctor}', 'DoctorController@destroy4cms');
    Route::get('doctors/{doctor}/password', 'DoctorController@resetPassword4cms');
    Route::post('doctors/{doctor}/password', 'DoctorController@updatePassword4cms');

// type
    Route::get('types', 'TypeController@index4cms');
    Route::get('types/create', 'TypeController@create4cms');
    Route::post('types', 'TypeController@store4cms');
    Route::get('types/{type}', 'TypeController@show4cms');
    Route::put('types/{type}', 'TypeController@update4cms');
    Route::delete('types/{type}', 'TypeController@destroy4cms');

// instance
    Route::get('instances', 'InstanceController@index4cms');
    Route::get('instances/create', 'InstanceController@create4cms');
    Route::post('instances', 'InstanceController@store4cms');
    Route::get('instances/{instance}', 'InstanceController@show4cms');
    Route::put('instances/{instance}', 'InstanceController@update4cms');
    Route::delete('instances/{instance}', 'InstanceController@destroy4cms');

// user
    Route::get('users', 'UserController@index4cms');
    Route::get('users/{user}', 'UserController@show4cms');
    Route::put('users/{user}', 'UserController@update4cms');
    Route::get('users/{user}/password', 'UserController@resetPassword4cms');
    Route::post('users/{user}/password', 'UserController@updatePassword4cms');

// order
    Route::get('orders', 'OrderController@index4cms');
    Route::get('orders/{order}', 'OrderController@show4cms');
    Route::put('orders/{order}', 'OrderController@update4cms');
    Route::get('orders/{order}/photos', 'OrderController@showPhotos4cms');
    Route::post('orders/{order}/photos', 'OrderController@storePhotos4cms');
    Route::get('orders/{order}/condition-report', 'OrderController@showConditionReport4cms');
    Route::post('orders/{order}/condition-report', 'OrderController@storeConditionReport4cms');

// helper
    Route::post('helper/upload-file', 'HelperController@uploadFile');

// news
    Route::get('news', 'NewsController@index4cms');
    Route::get('news/create', 'NewsController@create4cms');
    Route::post('news', 'NewsController@store4cms');
    Route::get('news/{news}', 'NewsController@show4cms');
    Route::put('news/{news}', 'NewsController@update4cms');
    Route::delete('news/{news}', 'NewsController@destroy4cms');

// department
    Route::get('departments', 'DepartmentController@index4cms');
    Route::get('departments/create', 'DepartmentController@create4cms');
    Route::post('departments', 'DepartmentController@store4cms');
    Route::get('departments/{department}', 'DepartmentController@show4cms');
    Route::put('departments/{department}', 'DepartmentController@update4cms');
    Route::delete('departments/{department}', 'DepartmentController@destroy4cms');

// master
    Route::get('masters', 'MasterController@index4cms');
    Route::get('masters/create', 'MasterController@create4cms');
    Route::post('masters', 'MasterController@store4cms');
    Route::get('masters/{department}/{master}', 'MasterController@show4cms');
    Route::put('masters/{department}/{master}', 'MasterController@update4cms');
    Route::delete('masters/{department}/{master}', 'MasterController@destroy4cms');
    Route::get('masters/{department}/{master}/password', 'MasterController@resetPassword4cms');
    Route::post('masters/{department}/{master}/password', 'MasterController@updatePassword4cms');
});






