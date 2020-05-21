<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin-panel')->name('admin-panel.')->group(function (){

    Route::get('', 'ServerController@index')->name('show');

    Route::get('server-status', 'ServerController@status')->name('server-status');

    Route::get('server-start', 'ServerController@start')->name('server-start');

    Route::get('server-stop', 'ServerController@stop')->name('server-stop');

    Route::get('server-update', 'ServerController@update')->name('server-update');

});
