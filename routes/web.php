<?php

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/admin/login');
Route::get('/admin/login', 'Admin\AuthController@login');
Route::post('/admin/login', 'Admin\AuthController@login_post');


Route::middleware(['guest', 'locale'])->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', 'HomeController@home');

    // users
    Route::resource('users', 'UsersController');

    // companies
    Route::resource('companies', 'CompaniesController');

    // employees
    Route::resource('employees', 'EmployeesController');

    Route::get('/logout', 'AuthController@logout');

    // set locale
    Route::get('/set-locale/{locale}', 'BaseController@change_locale');

});
