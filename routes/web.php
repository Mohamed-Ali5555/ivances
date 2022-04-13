<?php
use RealRashid\SweetAlert\Facades\Alert;

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
<<<<<<< HEAD
Route::resource('sections','SectionsController');
Route::resource('show','ProductsController');

###################################################3
// Route::post('/products/destroy','ProductsController@destroy')->name('products.destroy');

Route::post('/sections/destroy','SectionsController@destroy')->name('sections.destroy');
// Route::post('/sections/edit','SectionsController@edit')->name('sections.edit');
// Route::get('/sections/edit/{id}','SectionsController@edit')->name('sections.edit');

/////////////////////////////update product
// Route::post('/sections/update','SectionsController@update')->name('sections.update');


Route::post('/products/store','ProductsController@store')->name('products.store');

####################################################
=======
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
>>>>>>> ea9484a6b37d1067b91e6da92f46ca4ddca638e6
Route::get('/{page}', 'AdminController@index');
