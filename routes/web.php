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

#ToDo: paging problem when whole page goes to next page
Route::middleware(['logindate'])->group(function () {
    Route::get('/','Controller@welcome')->name('welcome');
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::Post('/login','Auth\LoginController@login');
    Route::Post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/verify','PaymentController@verify')->name('verify');
    Route::get('/unverified','PaymentController@unverified')->name('unverified');

    Route::middleware(['auth'])->group(function () {
        Route::get('/home','HomeController@index')->name('home');
        Route::post('/payment/create','PaymentController@create')->name('payment_create');
        Route::post('/loan/create','LoanController@create')->name('loan_create');
        Route::post('/user_note','NoteController@user_note')->name('user_note');
        Route::get('/loan/delete/{id}','LoanController@delete')->name('loan_delete');
        Route::get('/payment/delete/{id}','PaymentController@delete')->name('payment_delete');
        Route::get('/request/delete/{id}','RequestController@delete')->name('request_delete');
        Route::post('/request/create','RequestController@create')->name('request_create');
//        Route::get('/pdf/{id}/{mode}/{date}','PDFController@pdf')->name('pdf');
        Route::get('/pdf/all/{id}/','PDFController@full_pdf')->name('full_pdf');
        Route::get('/setpassword','UserController@setpasswordform')->name('setpassword_form');
        Route::post('/setpassword','UserController@setpassword')->name('setpassword');
    });
    Route::middleware(['auth','AdminAuth'])->group(function () {
        Route::get('/slider','SliderController@index')->name('slider');
        Route::get('/admin','AdminController@index')->name('admin');
        Route::get('/admin/transaction','AdminController@transaction')->name('admin_transaction');
        Route::get('/pdf/transaction','PDFController@transaction')->name('pdf_admin_transaction');
        Route::get('/admin/{id}','AdminController@user')->name('user');
        Route::get('/unproved1','AdminController@unproved1')->name('unproved1');
        Route::get('/unproved2','AdminController@unproved2')->name('unproved2');
        Route::get('/unproved3','AdminController@unproved3')->name('unproved3');
        Route::get('/notes','NoteController@index')->name('notes');
        Route::get('/notification','NotificationController@index')->name('notification');
        Route::get('/user/edit/{id}','UserController@edit')->name('user_edit');
        Route::get('/user/instalment1/acc_id','UserController@instalments1')->name('instalment1');
        Route::get('/user/instalment1/end_date','UserController@instalments_end_date1')->name('instalment_end_date1');
        Route::get('/user/instalment2/acc_id','UserController@instalments2')->name('instalment2');
        Route::get('/user/instalment2/end_date','UserController@instalments_end_date2')->name('instalment_end_date2');
        Route::get('/expense','ExpenseController@index')->name('expense');
    });
    Route::middleware(['auth','SuperAdminAuth'])->group(function () {
        Route::get('/config','ConfigController@show')->name('config');
        Route::delete('/config','ConfigController@delete');
        Route::post('/config','ConfigController@post');
        Route::get('/loan/edit/{id}','LoanController@show_edit')->name('edit_loan_form');
        Route::get('/payment/edit/{id}','PaymentController@show_edit')->name('edit_payment_form');
        Route::Post('/loan/edit/{id}','LoanController@edit')->name('edit_loan');
        Route::get('/loan/forcedelete/{id}','LoanController@forcedelete')->name('loan_forcedelete');
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
        Route::get('/request/edit/{id}','RequestController@form')->name('request_form');
        Route::post('/request/edit/{id}','RequestController@edit')->name('request_edit');
        Route::get('/request','RequestController@index')->name('request');
        Route::get('/request/confirm/{id}','RequestController@confirm')->name('request_confirm');
    });
});