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

//Homepage
Route::get('index',function(){
    return view('index');
});
//Search
Route::get('search', 'HospitalController@search');

//Recommend
Route::get('recommend',function(){
    return view('recommend');
});

//Mine
Route::get('user',function(){
    return view('user');
});

//Contact
Route::get('contact',function(){
    return view('contact');
});

//About
Route::get('about',function(){
    return view('about');
});

//Online Service   null

// query-method
Route::get('query-method', 'AppController@index');

//CMS Start

//City
Route::get('city/list','CityController@list');
Route::get('cities','CityController@cities');
Route::resource('city','CityController');

//Master
Route::get('master/list','MasterController@list');
Route::get('master/signin','MasterController@getLogin');
Route::post('master/signin','MasterController@postLogin');
Route::get('master/signout','MasterController@getLogout');
Route::get('master/profile','MasterController@profile');
Route::put('master/profile','MasterController@changePw');
Route::resource('master','MasterController');

//Hospital
Route::get('hospital/list','HospitalController@list');
Route::get('hospitals','HospitalController@hospitals');
Route::resource('hospital','HospitalController');

//Type
Route::get('type/list','TypeController@list');
Route::resource('type','TypeController');

//Case
Route::get('case/list','CaseController@list');
Route::resource('case','CaseController');

//Doctor
Route::get('doctor/list','DoctorController@list');
Route::get('doctor/signin','DoctorController@getLogin');
Route::post('doctor/signin','DoctorController@postLogin');
Route::get('doctor/dashboard','DoctorController@dashboard');
Route::post('doctor/dashboard','DoctorController@dashboard');
Route::get('doctors','DoctorController@doctors');
Route::get('doctor/{doctor}/display', 'DoctorController@display');
Route::resource('doctor','DoctorController');

//Order
Route::get('order/list','OrderController@list');
Route::get('order/{id}/photo','OrderController@editPhoto');
Route::post('order/{id}/photo','OrderController@addPhoto');
Route::delete('order/{id}/photo','OrderController@deletePhoto');
Route::get('order/{id}/report','OrderController@editReport');
Route::put('order/{id}/report','OrderController@updatePhoto');
Route::post('order/{id}/report/photo','OrderController@uploadReportPhoto');
Route::post('order/postPhotos','OrderController@postPhotos');
Route::post('order/create','OrderController@postCreate');
Route::get('order/{order}/display','OrderController@display');
Route::get('order/msg','OrderController@getMsg');
Route::resource('order','OrderController');

//News
Route::get('news/list','NewsController@list');
Route::resource('news','NewsController');

Route::get('cms', function(){
    return '欢迎';
});

//CMS End

