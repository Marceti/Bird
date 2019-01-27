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

Route::get('/projects/create','ProjectController@create');
Route::get('/projects','ProjectController@index')->name('projects');
Route::post('/projects','ProjectController@store');
Route::get('/projects/{project}','ProjectController@show');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//TODO: Formatarea cardurilor de la [Projects>index] si Partial [_projectIndexCard] - episode 9 min:13 - am de aranjat fontul in card