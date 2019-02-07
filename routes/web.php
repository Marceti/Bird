<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* Project */
Route::get('/projects/create','ProjectController@create');
Route::get('/projects','ProjectController@index')->name('projects');
Route::post('/projects','ProjectController@store');
Route::get('/projects/{project}','ProjectController@show');

/* Project/Task */
Route::post('/projects/{project}/tasks','ProjectTasksController@store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


