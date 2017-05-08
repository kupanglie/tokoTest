<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/getLengthCategory', 'ItemsOutController@getLengthCategory');
Route::get('/getActualLength', 'ItemsOutController@getActualLength');
Route::get('/getThickCategory', 'ItemsOutController@getThickCategory');
Route::get('/getQuantity', 'ItemsOutController@getQuantity');

//Project
Route::resource('projects', 'ProjectsController');
Route::post('update-support-item', 'ProjectsController@postUpdateSupportItem')->name('update-support-item');


//Stock Management
Route::resource('list-items', 'ListItemsController');
Route::post('edit-item-price', 'ListItemsController@postEditItemPrice')->name('update-item-price');
Route::get('opname-items/pdf', 'ListItemsController@getOpnameItems')->name('opname-items');

Route::resource('list-preorders', 'ListPreordersController');
Route::get('edit-preorder/{id}', 'ListPreordersController@getEditPreorder')->name('edit-preorder');
Route::post('edit-preorder', 'ListPreordersController@postEditPreorder')->name('update-preorder');
Route::get('list-preorders/pdf/{id}', 'ListPreordersController@getPreorderPdf')->name('preorder-invoice');
Route::get('list-recap/pdf/{id}', 'ListPreordersController@getRecapPdf')->name('recap-invoice');
Route::post('verify-invoice', 'ListPreordersController@postVerifyInvoice')->name('verify-invoice');

Route::resource('items-in', 'ItemsInController');
Route::resource('items-out', 'ItemsOutController');

//Setting
Route::resource('item-management', 'ItemManagementController');
Route::resource('sales-management', 'SalesManagementController');
Route::resource('worker-management', 'WorkerManagementController');
Route::resource('suppliers-management', 'SuppliersManagementController');
Route::resource('expeditions-management', 'ExpeditionsController');
