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
Route::get('/projects/create', 'ProjectController@create');
Route::get('/projects', 'ProjectController@index')->name('projects');
Route::post('/projects', 'ProjectController@store');
Route::get('/projects/{project}', 'ProjectController@show');
Route::get('/projects/{project}/edit', 'ProjectController@edit');
Route::patch('/projects/{project}', 'ProjectController@update');

Route::delete('/projects/{project}', 'ProjectController@destroy');
/* Project/Task */
Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
