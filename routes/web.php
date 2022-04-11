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

Route::resource('invoices','InvoicesController');
// Route::resource('sections','SectionsController');
###################################################
Route::get('/sections','SectionsController@index')->name('sections.sections');

###################################################
// Route::get('sections/sections/edit/{id}','SectionsController@edit')->name('/sections');
// Route::post('sections/sections/update','SectionsController@update')->name('/sections');
Route::post('/sections/store','SectionsController@store')->name('sections.store');

Route::get('/sections/edit/{id}','SectionsController@edit')->name('sections.edit');
Route::post('/sections/update','SectionsController@update')->name('sections.update');
################################################
Route::get('/{page}', 'AdminController@index');
