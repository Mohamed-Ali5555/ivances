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
##################################################################################
Route::get('/Section/{id}','InvoicesController@getproducts');
//////////////////////////////////////////////////////////////////////////////////
Route::get('/invoices/invoices_details/{id}','InvoicesDetailsController@show')->name('invoices.invoices_details');


Route::get('View_file/{invoice_number}/{file_name}','InvoicesDetailsController@open_file');
Route::get('download/{invoice_number}/{file_name}','InvoicesDetailsController@get_file');
Route::post('delete_file','InvoicesDetailsController@destroy')->name('delete_file');
// invoices table 
// edit envoices 
Route::get('invoices/edit_invoices/{id}','InvoicesController@edit')->name('invoices.edit_invoices');
Route::post('invoices/update','InvoicesController@update')->name('invoices.update');
/////////////////////////////image update///////////////////////////////////
Route::post('/invoices/invoices_details/store','InvoicesAttachmentsController@store')->name('Invoices_details.store');

Route::post('/invoices/destroy','InvoicesController@destroy')->name('invoices.destroy');


Route::get('invoices/change_status/{id}','InvoicesController@change_status')->name('invoices.change_status');
Route::post('/update_status/update/{id}','InvoicesController@update_status')->name('invoices.update_status');

//////////////////////////////////////////////////////////////////////
// archeve page and routes 
Route::get('/archevis_invoices','ArchevisController@index')->name('archevis_invoices');
// return from archeve to invoices table 
Route::post('/archevis_invoices/update','ArchevisController@update')->name('archeve.update');
// delete 
Route::delete('/archevis_invoices/destroy','ArchevisController@destroy')->name('archeve.destroy');

// status condion 

Route::get('/paid_invoices','InvoicesController@paid_status')->name('paid_invoices');
Route::get('/partpaid_invoices','InvoicesController@unpaid_status')->name('partpaid_invoices');
Route::get('/unpaid_invoices','InvoicesController@paidpart_status')->name('unpaid_invoices');
// priny invoices 
Route::get('/print_invoices/{id}','InvoicesController@print_invoices')->name('invoices.print_invoices');
// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// excel route 
// Route::get('export_invoices/', [InvoicesController::class, 'export']);
Route::get('export_invoices','InvoicesController@export');

// Route::get('/invoices/invoices_details/{id}','InvoicesDetailsController@show')->name('invoices.invoices_details');
###############################################################
##################################################################
    //    invoices_report 
    Route::get('/invoices_report','Invoices_reportController@index')->name('invoices_report');
    Route::post('/search_invoices','Invoices_reportController@Search_invoices')->name('Search_invoices');

########################################################
         //customer report
    Route::get('/customers_report','Customers_reportController@index')->name('customers_report');
    Route::post('/customer_search','Customers_reportController@Search_customers')->name('customer_search');

###########################################################
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('/users/destroy','UserController@destroy')->name('users.destroy');

    
});

####################################################
Route::get('/{page}', 'AdminController@index');
