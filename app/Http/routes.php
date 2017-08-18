<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//welcome page
Route::get('/', function () {
    return view('welcome');
});


Route::auth();


// crm system main page
Route::get('/home', ['uses'=>'HomeController@index', 'as'=>'home']);

// adding authentication middleware to system
Route::group(['middleware' => 'auth'], function () {


    // selecting resource for further use for editing and deleting
    Route::resource('employee', 'EmployeeController');
    Route::resource('customer', 'CustomerController');


    //adding other customer-related processes

    Route::get('customer/{customer}/action-create', ['uses'=>'CustomerController@createAction','as'=>'customer-action.create']);
    Route::post('customer/{customer}/action-store', ['uses'=>'CustomerController@storeAction','as'=>'customer-action.store']);

    Route::get('customer/{customer}/employee-edit', ['uses'=>'CustomerController@editEmployee','as'=>'customer-employee.edit']);
    Route::patch('customer/{customer}/employee-update', ['uses'=>'CustomerController@updateEmployee','as'=>'customer-employee.update']);



});




