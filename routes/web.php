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
    Route::get('AssetBorrowing',    'AssetBorrowingMainController@index')->name('AssetBorrowing');
    Route::get('AssetBorrowing/getdataforindexpage', 'AssetBorrowingMainController@getdataforindexpage')->name('AssetBorrowing.getdataforindexpage');
    Route::get('AssetBorrowing/getdataforcreatnew', 'AssetBorrowingMainController@getdataforcreatnew')->name('AssetBorrowing.getdataforcreatnew');

    Route::get('AssetBorrowing/create', 'AssetBorrowingMainController@create')->name('AssetBorrowing.create');

   // Route::post('ajaxdata/postdata', 'AjaxdataController@postdata')->name('ajaxdata.postdata');
    
   // Route::get('ajaxdata/fetchdata', 'AjaxdataController@fetchdata')->name('ajaxdata.fetchdata');
  //  Route::get('ajaxdata/removedata', 'AjaxdataController@removedata')->name('ajaxdata.removedata');
    //Route::get('ajaxdata/massremove', 'AjaxdataController@massremove')->name('ajaxdata.massremove');
   // Route::get('ajaxdata/masscreate', 'AjaxdataController@masscreate')->name('ajaxdata.masscreate');
});