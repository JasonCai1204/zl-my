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

// cms
Route::group(['domain' => 'cms.deego.app', 'namespace' => 'cms'], function () {

    Route::get('/', 'HomeController@index');

    Route::group(['namespace' => 'Auth'], function () {

        Route::get('login', 'LoginController@showLoginForm');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout');
        Route::get('password/reset', 'ResetPasswordController@showResetForm');
        Route::post('password/reset', 'ResetPasswordController@reset');

    });

    Route::get('cms.notice',function(){
        return view('cms.notice');
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
    Route::get('doctors/{doctor}/reviews', 'DoctorController@reviews');

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

    // news
    Route::get('news', 'NewsController@index');
    Route::get('news/create', 'NewsController@create');
    Route::post('news', 'NewsController@store');
    Route::get('news/{news}', 'NewsController@show');
    Route::put('news/{news}', 'NewsController@update');
    Route::delete('news/{news}', 'NewsController@destroy');

    // news_class
    Route::get('news_class','News_classController@index');
    Route::get('news_class/create','News_classController@create');
    Route::post('news_class','News_classController@store');
    Route::get('news_class/{news_class}','News_classController@show');
    Route::put('news_class/{news_class}','News_classController@update');
    Route::delete('news_class/{news_class}','News_classController@destroy');

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

    // review
    Route::get('reviews', 'ReviewController@index');
    Route::get('reviews/create', 'ReviewController@create');
    Route::get('reviews/{review}', 'ReviewController@show');
    Route::post('reviews', 'ReviewController@store');
    Route::put('reviews/{review}', 'ReviewController@update');
    Route::delete('reviews/{review}', 'ReviewController@destroy');
});


Route::group(['namespace' => 'web'], function() {

    // ys
    Route::group(['domain' => 'ys.zl-my.com'], function () {

        // Doctor Authontication
        Route::group(['namespace' => 'Auth\ys'], function () {
            Route::get('login', 'LoginController@showLoginForm');
            Route::post('login', 'LoginController@login');
            Route::post('logout', 'LoginController@logout');
            Route::get('account/password/reset', 'ResetPasswordController@showResetForm');
            Route::post('account/password/reset', 'ResetPasswordController@reset');
        });

        // Redirect notice
        Route::get('doctors.notice',function (){
            return view('web.doctors.notice');
        });

        // Profile
        Route::get('account/profile','DoctorController@getProfile');

        // Order lists
        Route::get('/','OrderController@getDoctorOrders');

        // Condition_report
        Route::get('orders/condition_report','DoctorController@getCondition_report');

    });

    // User Authontication
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('login', 'LoginController@showLoginForm');
        Route::post('login', 'LoginController@login');
        Route::get('register', 'RegisterController@showRegistrationForm');
        Route::post('register', 'RegisterController@register');
        Route::post('logout', 'LoginController@logout');
        Route::get('account/password/reset', 'ResetPasswordController@showResetForm');
        Route::post('account/password/reset', 'ResetPasswordController@reset');
    });

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

    // Hospital
    Route::get('hospital/select','HospitalController@getSelect');
    Route::get('hospitals','HospitalController@getHospitals');
    Route::resource('hospital','HospitalController');

    // Instance
    Route::get('instance/select','InstanceController@getSelect');
    Route::resource('instance','InstanceController');

    // Doctor
    Route::get('doctor/select','DoctorController@getSelect');
    Route::get('doctors','DoctorController@getDoctors');
    Route::resource('doctor','DoctorController');

    // Order
    Route::post('order/postPhotos','OrderController@postPhotos');
    Route::get('orders/create','OrderController@getCreate');
    Route::post('orders/create','OrderController@postCreate');
    Route::get('order/{order}/display','OrderController@display');
    Route::get('order/msg','OrderController@getMsg');
    Route::get('account/user/orders','OrderController@getUserOrders');
    Route::resource('order','OrderController');

    // User account.
    Route::resource('account','UserController@index');

    // Profile
    Route::get('account/user/profile','UserController@getProfile');
    Route::post('account/user/profile','UserController@postProfile');

    // Review
    Route::get('review/{doctor}/create','ReviewController@create');
    Route::post('review','ReviewController@store');
    Route::get('review/{doctor}/reviews','ReviewController@getDoctorReviews');
    Route::get('review/{doctor}/loadMore','ReviewController@loadMoreDoctorReviews');
    Route::get('review/{patient}/reviews','ReviewController@getPatientReviews');
    Route::get('review/{patient}/loadMore','ReviewController@loadMorePatientReviews');

    // Contact
    Route::get('contact',function(){
        return view('web.app.contact');
    });

    // Qa
    Route::get('support/qa',function(){
        return view('web.app.qa');
    });

    // About
    Route::get('about',function(){
        return view('web.app.about');
    });

    // Services
    Route::get('legal/terms',function(){
        return view('web.app.services');
    });

    // Download
    Route::get('downloads',function(){
        return view('www.downloads');
    });

    // helper
    Route::post('helper/upload-file', 'HelperController@uploadFile');
});
