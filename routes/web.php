<?php

Route::get('/', 'HomeController@index');

Route::get('signup', 'SignupController@index');
Route::post('signup', 'SignupController@store');

Route::get('user', 'UserController@index');
Route::get('users', 'UserController@users');
Route::get('roles', 'UserController@role');
Route::post('user', 'UserController@store');
Route::post('updateUser', 'UserController@update');
Route::get('stylists', 'UserController@stylists');
Route::get('stylist', 'UserController@stylist');
Route::post('stylists', 'UserController@storestylist');

Route::post('login', 'LoginController@login');
Route::get('auth', 'LoginController@auth');
Route::get('logout', 'LoginController@logout');

Route::get('salon', 'SalonController@index');
Route::post('salon', 'SalonController@update');

Route::get('client', 'ClientController@index');
Route::get('clients', 'ClientController@clients');
Route::get('client/{id}', 'ClientController@show');
Route::post('client', 'ClientController@store');

Route::get('appointment', 'AppointmentController@index');
Route::get('appointments', 'AppointmentController@appointments');
Route::post('appointment', 'AppointmentController@store');
Route::delete('appointment/{id}', 'AppointmentController@delete');

Route::get('hair', 'HairController@index');
Route::get('hair/{id}', 'HairController@show');
Route::post('hair', 'HairController@store');

Route::get('makeup', 'MakeupController@index');
Route::get('makeup/{id}', 'MakeupController@show');
Route::post('makeup', 'MakeupController@store');

Route::get('service', 'ServiceController@index');
Route::post('service', 'ServiceController@store');
Route::post('editService', 'ServiceController@update');
Route::delete('service/{id}', 'ServiceController@delete');

Route::get('groups', 'GroupController@index');
Route::post('groups', 'GroupController@store');

// Route::get('contact', 'ContactController@index');
// Route::get('contact', function () {
//     Mail::to('f388bcc3f9-909b99@inbox.mailtrap.io')->send(new Welcome);
//
//     return view('welcome');
// });
