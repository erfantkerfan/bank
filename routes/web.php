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

//Landing Page
Route::get('/', function () {
    return view('welcome');
});

//ToDo add cron job to server & storage:link

Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::Post('/login','Auth\LoginController@login');
Route::Post('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/user/register','Auth\RegisterController@showRegistrationForm')->name('register')          ->middleware('SuperAdminAuth');
Route::Post('/user/register','Auth\RegisterController@register')                                       ->middleware('SuperAdminAuth');

Route::get('/user/edit/{id}','UserController@edit')->name('user_edit')                                 ->middleware('SuperAdminAuth');
Route::Post('/user/edit/{id}','UserController@user_edit')                                              ->middleware('SuperAdminAuth');
Route::get('/user/instalment','UserController@instalments')->name('instalment')                                             ->middleware('SuperAdminAuth');
Route::get('/user/instalment/{id}','UserController@delete_instalment')->name('delete_instalment')     ->middleware('SuperAdminAuth');

Route::get('/home', 'HomeController@index')->name('home')                                              ->middleware('auth');
Route::post('/payment/create', 'PaymentController@create')->name('payment_create')                     ->middleware('auth');
Route::post('/loan/create', 'LoanController@create')->name('loan_create')                              ->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin')                                           ->middleware('AdminAuth');
Route::get('/admin/{id}', 'AdminController@user')->name('user')                                        ->middleware('AdminAuth');;
Route::get('/not_proved', 'AdminController@not_proved')->name('not_proved')                            ->middleware('AdminAuth');
Route::get('/notes', 'NoteController@index')->name('notes')                                            ->middleware('AdminAuth');
Route::get('/notes/delete/{id}', 'NoteController@delete')->name('delete_notes')                        ->middleware('AdminAuth');

Route::get('/loan/delete/{id}', 'LoanController@delete')->name('loan_delete')                          ->middleware('SuperAdminAuth');
Route::get('/loan/confirm/{id}', 'LoanController@confirm')->name('loan_confirm')                       ->middleware('SuperAdminAuth');
Route::get('/payment/delete/{id}', 'PaymentController@delete')->name('payment_delete')                 ->middleware('SuperAdminAuth');
Route::get('/payment/confirm/{id}', 'PaymentController@confirm')->name('payment_confirm')              ->middleware('SuperAdminAuth');
Route::get('/notification', 'NotificationController@index')->name('notification')                      ->middleware('AdminAuth');
Route::get('/notification/delete/{id}', 'NotificationController@delete')->name('notification_delete')  ->middleware('SuperAdminAuth');
Route::post('/notification/create', 'NotificationController@create')->name('notification_create')      ->middleware('SuperAdminAuth');