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


//TODO: Am instalat talewind, am inceput sa modific stilurile, am ajuns la episodul 9 min :3 , la shadows, am de configurat cardul, sa pun umbra , culoare ... sia apoi sa le aranjam mai bine in pagina , acum containerul este flex (de taleWind) dar mai vedem