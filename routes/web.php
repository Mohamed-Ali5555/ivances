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
Route::get('/{page}', 'AdminController@index');
