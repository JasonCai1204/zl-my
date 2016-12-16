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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');

Route::group(['namespace' => 'api'], function(){

   // Index
   Route::get('/','WebController@index');

   // Search
   Route::get('search', 'HospitalController@search');

   // News lists
   Route::resource('news','NewsController');

   // Recommend
   Route::get('recommends','WebController@recommend');

   // Find Doctors
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

   // Order
   Route::post('order/postPhotos','OrderController@postPhotos');
   Route::get('orders/create','OrderController@getCreate');
   Route::post('orders/create','OrderController@postCreate');
   Route::get('order/msg','OrderController@getMsg');
   Route::resource('order','OrderController');

   // Instance
   Route::get('instance/select','InstanceController@getSelect');
   Route::get('instance/doctor/select','InstanceController@getDoctorSelect');


});




