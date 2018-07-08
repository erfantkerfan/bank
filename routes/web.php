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

Route::get('/','Controller@welcome')->name('welcome');
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::Post('/login','Auth\LoginController@login');
Route::Post('/logout','Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home','HomeController@index')->name('home');
    Route::post('/payment/create','PaymentController@create')->name('payment_create');
    Route::post('/loan/create','LoanController@create')->name('loan_create');
    Route::post('/user_note','NoteController@user_note')->name('user_note');
    Route::get('/loan/delete/{id}','LoanController@delete')->name('loan_delete');
    Route::get('/payment/delete/{id}','PaymentController@delete')->name('payment_delete');
    Route::get('/request/delete/{id}','RequestController@delete')->name('request_delete');#
    Route::post('/request/create','RequestController@create')->name('request_create');#
    });
Route::middleware(['auth','AdminAuth'])->group(function () {
    Route::get('/slider','SliderController@index')->name('slider');
    Route::get('/admin','AdminController@index')->name('admin');
    Route::get('/admin/{id}','AdminController@user')->name('user');
    Route::get('/unproved','AdminController@unproved')->name('unproved');
    Route::get('/notes','NoteController@index')->name('notes');
    Route::get('/notification','NotificationController@index')->name('notification');
    Route::get('/user/edit/{id}','UserController@edit')->name('user_edit');
    Route::get('/user/instalment/acc_id','UserController@instalments')->name('instalment');
    Route::get('/user/instalment/end_date','UserController@instalments_end_date')->name('instalment_end_date');
    Route::get('/expense','ExpenseController@index')->name('expense');
});
Route::middleware(['auth','SuperAdminAuth'])->group(function () {
    Route::get('/loan/edit/{id}','LoanController@show_edit')->name('edit_loan_form');
    Route::get('/payment/edit/{id}','PaymentController@show_edit')->name('edit_payment_form');
    Route::Post('/loan/edit/{id}','LoanController@edit')->name('edit_loan');
    Route::Post('/payment/edit/{id}','PaymentController@edit')->name('edit_payment');
    Route::get('/slider/delete/{id}','SliderController@delete')->name('delete_slider');
    Route::Post('/slider/create','SliderController@create')->name('create_slider');
    Route::get('/notes/delete/{id}','NoteController@delete')->name('delete_note');
    Route::get('/user_notes/delete/{id}','NoteController@delete_user')->name('delete_user_note');
    Route::get('/user/register','Auth\RegisterController@showRegistrationForm')->name('register');
    Route::Post('/user/register','Auth\RegisterController@register');
    Route::Post('/user/edit/{id}','UserController@user_edit');
    Route::get('/user/delete/acc_id/instalment/{id}','UserController@delete_instalment')->name('delete_instalment');
    Route::get('/user/delete/acc_id/instalment_force/{id}','UserController@delete_instalment_force')->name('delete_instalment_force');
    Route::get('/loan/confirm/{id}','LoanController@confirm')->name('loan_confirm');
    Route::get('/payment/confirm/{id}','PaymentController@confirm')->name('payment_confirm');
    Route::get('/notification/delete/{id}','NotificationController@delete')->name('notification_delete');
    Route::post('/notification/create','NotificationController@create')->name('notification_create');
    Route::get('/expense/delete/{id}','ExpenseController@delete')->name('expense_delete');
    Route::post('/expense/create','ExpenseController@create')->name('expense_create');
    Route::get('/request/edit/{id}','RequestController@form')->name('request_form');#
    Route::post('/request/edit/{id}','RequestController@edit')->name('request_edit');#
    Route::get('/request','RequestController@index')->name('request');#
});