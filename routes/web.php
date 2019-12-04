<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {

   return view('welcome');
});

//AjaxWork Crud Route
Route::get('/company', 'CompanyController@index')->name('company.index');
Route::get('/addcompany', 'CompanyController@view')->name('company.view');
Route::post('/addcompany', 'CompanyController@Store')->name('company.store');
Route::delete('/addcompany/{id}', 'CompanyController@destroy')->name('company.destroy');
Route::get('/addcompany/{id}/edit', 'CompanyController@update')->name('company.update');

//Datatable Examples
Route::get('users', 'DatatableController@index');
Route::get('getusers', 'DatatableController@getUsers')->name('datatables.users');

//Working with vue js
// Route::get('/{anypath}','HomeController@index')->where('path','.*');

//Download Pdf
Route::get('/pdf', function () {
   return view('invoice');
});

//SMS Notification
Route::get("/sms", "SmsController@show");
Route::post("/sms", "SmsController@send");

//SinglePostRoute
Route::get('/blog/{id}', 'HomeController@getPostBySlug');
Route::get('/categorypost/{id}', 'HomeController@getPostByCategory');
Route::get('/search', 'HomeController@search_post');

//Laravel Real Time Chat With Laravel Echo and Web socket
Route::get('/chats', 'ChatController@index');
Route::get('/messages', 'ChatController@fetchAllMessages');
Route::post('/messages', 'ChatController@sendMessage');

//Highchart Example Route
Route::get('chart', 'ChartController@index');
