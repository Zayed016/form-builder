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
Auth::routes();
Route::group(['middleware' => ['auth'],'prefix'=>'admin'], function () {

Route::get('tableList','DatabaseController@tableList')->name('tableList');
Route::post('saveTable','DatabaseController@saveTable')->name('saveTable');
Route::post('updateTable','DatabaseController@updateTable')->name('updateTable');
Route::get('emptyTable/{table}','DatabaseController@emptyTable')->name('emptyTable');
Route::get('deleteTable/{table}','DatabaseController@deleteTable')->name('deleteTable');

Route::get('tableColumnlist/{table}','DatabaseController@tableColumnlist')->name('tableColumnlist');
Route::post('saveColumn/{table}','DatabaseController@saveColumn')->name('saveColumn');
Route::post('updateColumn/{table}','DatabaseController@updateColumn')->name('updateColumn');
Route::get('deleteTableColumn/{table}/{column}','DatabaseController@deleteTableColumn')->name('deleteTableColumn');

Route::post('getTablesForForm','DatabaseController@getTablesForForm')->name('getTablesForForm');
Route::get('selectColumnforForm/{id}','DatabaseController@selectColumnforForm')->name('selectColumnforForm');
Route::post('makeForm/{id}','DatabaseController@makeForm')->name('makeForm');
Route::get('editformInputType/{id}','DatabaseController@editformInputType')->name('editformInputType');
Route::post('updateFormInputField/{id}','DatabaseController@updateFormInputField')->name('updateFormInputField');
Route::post('saveOption/{id}','DatabaseController@saveOption')->name('saveOption');

Route::post('saveDynamicOption/{id}','DatabaseController@saveDynamicOption')->name('saveDynamicOption'); 
Route::get('formList','DatabaseController@formList')->name('formList');
Route::get('formAddData/{id}','DatabaseController@formAddData')->name('formAddData');    
Route::post('submitForm/{id}','DatabaseController@submitForm')->name('submitForm');
Route::get('formHistory/{id}','DatabaseController@formHistory')->name('formHistory');
Route::get('editFormHistory/{fid}/{id}','DatabaseController@editFormHistory')->name('editFormHistory');
Route::post('updateSubmitedForm/{id}/{pid}','DatabaseController@updateSubmitedForm')->name('updateSubmitedForm');
Route::get('deleteFormData/{fid}/{id}','DatabaseController@deleteFormData')->name('deleteFormData');

Route::get('deleteData/{table}/{id}','CommonController@deleteData')->name('deleteData');
});

Route::get('/home', 'HomeController@index')->name('home');
