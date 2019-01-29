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


//TODO: Formatarea cardurilor e gata , Am, de facut [projects.show] - episode 11 min:2:00 , repeta talewind:settings (pot scimba culori) :add components (ex bird-card, bird-button) - astea le-am facut eu