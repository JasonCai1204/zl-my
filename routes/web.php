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

// ys
Route::group(['domain' => 'ys.zl-my.com', 'namespace' => 'ys'], function () {

    Route::get('/', function () {
        echo 'Hello world!';
    });
});

// cms
Route::group(['domain' => 'cms.zl-my.com', 'namespace' => 'cms'], function () {

    Route::get('/', function () {
        return view('cms.home');
    });

    // city
    Route::get('cities', 'CityController@index');
    Route::get('cities/create', 'CityController@create');
    Route::post('cities', 'CityController@store');
    Route::get('cities/{city}', 'CityController@show');
    Route::put('cities/{city}', 'CityController@update');
    Route::delete('cities/{city}', 'CityController@destroy');

    // hospital
    Route::get('hospitals', 'HospitalController@index');
    Route::get('hospitals/create', 'HospitalController@create');
    Route::post('hospitals', 'HospitalController@store');
    Route::get('hospitals/{hospital}', 'HospitalController@show');
    Route::put('hospitals/{hospital}', 'HospitalController@update');
    Route::delete('hospitals/{hospital}', 'HospitalController@destroy');

    // doctor
    Route::get('doctors', 'DoctorController@index');
    Route::get('doctors/create', 'DoctorController@create');
    Route::post('doctors', 'DoctorController@store');
    Route::get('doctors/{doctor}', 'DoctorController@show');
    Route::put('doctors/{doctor}', 'DoctorController@update');
    Route::delete('doctors/{doctor}', 'DoctorController@destroy');
    Route::get('doctors/{doctor}/password', 'DoctorController@resetPassword');
    Route::post('doctors/{doctor}/password', 'DoctorController@updatePassword');

    // type
    Route::get('types', 'TypeController@index');
    Route::get('types/create', 'TypeController@create');
    Route::post('types', 'TypeController@store');
    Route::get('types/{type}', 'TypeController@show');
    Route::put('types/{type}', 'TypeController@update');
    Route::delete('types/{type}', 'TypeController@destroy');

    // instance
    Route::get('instances', 'InstanceController@index');
    Route::get('instances/create', 'InstanceController@create');
    Route::post('instances', 'InstanceController@store');
    Route::get('instances/{instance}', 'InstanceController@show');
    Route::put('instances/{instance}', 'InstanceController@update');
    Route::delete('instances/{instance}', 'InstanceController@destroy');

    // user
    Route::get('users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show');
    Route::put('users/{user}', 'UserController@update');
    Route::get('users/{user}/password', 'UserController@resetPassword');
    Route::post('users/{user}/password', 'UserController@updatePassword');

    // order
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{order}', 'OrderController@show');
    Route::put('orders/{order}', 'OrderController@update');
    Route::get('orders/{order}/photos', 'OrderController@showPhotos');
    Route::post('orders/{order}/photos', 'OrderController@storePhotos');
    Route::get('orders/{order}/condition-report', 'OrderController@showConditionReport');
    Route::post('orders/{order}/condition-report', 'OrderController@storeConditionReport');

    // helper
    Route::post('helper/upload-file', 'HelperController@uploadFile');

    // news
    Route::get('news', 'NewsController@index');
    Route::get('news/create', 'NewsController@create');
    Route::post('news', 'NewsController@store');
    Route::get('news/{news}', 'NewsController@show');
    Route::put('news/{news}', 'NewsController@update');
    Route::delete('news/{news}', 'NewsController@destroy');

    // department
    Route::get('departments', 'DepartmentController@index');
    Route::get('departments/create', 'DepartmentController@create');
    Route::post('departments', 'DepartmentController@store');
    Route::get('departments/{department}', 'DepartmentController@show');
    Route::put('departments/{department}', 'DepartmentController@update');
    Route::delete('departments/{department}', 'DepartmentController@destroy');

    // master
    Route::get('masters', 'MasterController@index');
    Route::get('masters/create', 'MasterController@create');
    Route::post('masters', 'MasterController@store');
    Route::get('masters/{master}', 'MasterController@show');
    Route::put('masters/{master}', 'MasterController@update');
    Route::delete('masters/{master}', 'MasterController@destroy');
    Route::get('masters/{master}/password', 'MasterController@resetPassword');
    Route::post('masters/{master}/password', 'MasterController@updatePassword');
});


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
