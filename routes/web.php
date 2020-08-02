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

Route::resource('assets', 'AssetController');
Route::resource('locations', 'LocationController');
Route::resource('sublocations', 'SublocationController');

Route::resource('brands', 'BrandController');
Route::resource('categories', 'CategoryController');
Route::resource('subcategories', 'SubcategoryController');
Route::resource('subcategories', 'SubcategoryController');
//Route::resource('assetborrowingmains', 'AssetBorrowingMainController');

Route::group(['middleware' => ['web']], function() {
    //Route::resource('students','StudentController');
    Route::get('AssetBorrowing',    'AssetBorrowingMainController@index')->name('AssetBorrowing');
    Route::get('AssetBorrowing/getdata', 'AssetBorrowingMainController@getdata')->name('AssetBorrowing.getdata');

    //Route::get('ajaxdata/getdata', 'AjaxdataController@getdata')->name('ajaxdata.getdata');

   // Route::post('ajaxdata/postdata', 'AjaxdataController@postdata')->name('ajaxdata.postdata');
    
   // Route::get('ajaxdata/fetchdata', 'AjaxdataController@fetchdata')->name('ajaxdata.fetchdata');
  //  Route::get('ajaxdata/removedata', 'AjaxdataController@removedata')->name('ajaxdata.removedata');
    //Route::get('ajaxdata/massremove', 'AjaxdataController@massremove')->name('ajaxdata.massremove');
   // Route::get('ajaxdata/masscreate', 'AjaxdataController@masscreate')->name('ajaxdata.masscreate');
});