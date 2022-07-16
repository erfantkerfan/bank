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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//TODO: php artisan check:blade_queries use view:composer
//TODO: update blade errors artisan vendor:publish --tag=laravel-errors
Route::middleware(['logindate'])->group(function () {
    Route::get('/',[Controller::class, 'welcome'])->name('welcome');
    Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
    Route::Post('/login',[LoginController::class, 'login']);
    Route::Post('/logout',[LoginController::class, 'logout'])->name('logout');
    Route::get('/verify',[PaymentController::class, 'verify'])->name('verify');
    Route::get('/unverified',[PaymentController::class, 'unverified'])->name('unverified');
    Route::middleware(['auth'])->group(function () {
        Route::get('/home',[HomeController::class, 'index'])->name('home');
        Route::post('/payment/create',[PaymentController::class, 'create'])->name('payment_create');
        Route::post('/loan/create',[LoanController::class, 'create'])->name('loan_create');
        Route::post('/user_note',[NoteController::class, 'user_note'])->name('user_note');
        Route::get('/loan/delete/{id}',[LoanController::class, 'delete'])->name('loan_delete');
        Route::get('/payment/delete/{id}',[PaymentController::class, 'delete'])->name('payment_delete');
        Route::get('/request/delete/{id}',[RequestController::class, 'delete'])->name('request_delete');
        Route::post('/request/create',[RequestController::class, 'create'])->name('request_create');
        Route::get('/export/all/{id}/',[ExportController::class, 'full'])->name('full_export');
        Route::get('/setpassword',[UserController::class, 'setpasswordform'])->name('setpassword_form');
        Route::post('/setpassword',[UserController::class, 'setpassword'])->name('setpassword');
    });
    Route::middleware(['auth','AdminAuth'])->group(function () {
        Route::get('/slider',[SliderController::class, 'index'])->name('slider');
        Route::get('/admin',[AdminController::class, 'index'])->name('admin');
        Route::get('/admin/transaction',[AdminController::class, 'transaction'])->name('admin_transaction');
        Route::get('/export/transaction',[ExportController::class, 'transaction'])->name('admin_transaction_export');
        Route::get('/admin/report/loan',[AdminController::class, 'loan_report'])->name('loan_report');
        Route::get('/admin/{id}',[AdminController::class, 'user'])->name('user');
        # TODO: fix these namings
        Route::get('/unproved1',[AdminController::class, 'unproved1'])->name('unproved1');
        Route::get('/unproved2',[AdminController::class, 'unproved2'])->name('unproved2');
        Route::get('/unproved3',[AdminController::class, 'unproved3'])->name('unproved3');

        Route::get('/notes',[NoteController::class, 'index'])->name('notes');
        Route::get('/notification',[NotificationController::class, 'index'])->name('notification');
        Route::get('/user/edit/{id}',[UserController::class, 'edit'])->name('user_edit');
        Route::get('/user/normal_instalments',[UserController::class, 'normal_instalments'])->name('normal_instalments');
        Route::get('/user/force_instalments',[UserController::class, 'force_instalments'])->name('force_instalments');
        Route::get('/expense',[ExpenseController::class, 'index'])->name('expense');
    });
    Route::middleware(['auth','SuperAdminAuth'])->group(function () {
        Route::get('/database',[AdminController::class, 'database'])->name('database');
        Route::get('/config',[ConfigController::class, 'show'])->name('config');
        Route::delete('/config',[ConfigController::class, 'delete']);
        Route::post('/config',[ConfigController::class, 'post']);
        Route::get('/loan/edit/{id}',[LoanController::class, 'show_edit'])->name('edit_loan_form');
        Route::get('/payment/edit/{id}',[PaymentController::class, 'show_edit'])->name('edit_payment_form');
        Route::Post('/loan/edit/{id}',[LoanController::class, 'edit'])->name('edit_loan');
        Route::get('/loan/forcedelete/{id}',[LoanController::class, 'forcedelete'])->name('loan_forcedelete');
        Route::Post('/payment/edit/{id}',[PaymentController::class, 'edit'])->name('edit_payment');
        Route::get('/slider/delete/{id}',[SliderController::class, 'delete'])->name('delete_slider');
        Route::Post('/slider/create',[SliderController::class, 'create'])->name('create_slider');
        Route::get('/notes/delete/{id}',[NoteController::class, 'delete'])->name('delete_note');
        Route::get('/user_notes/delete/{id}',[NoteController::class, 'delete_user'])->name('delete_user_note');
        Route::get('/user/register',[RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::Post('/user/register',[RegisterController::class, 'register']);
        Route::Post('/user/edit/{id}',[UserController::class, 'user_edit']);
        Route::get('/user/delete/acc_id/instalment/{id}',[UserController::class, 'delete_instalment'])->name('delete_instalment');
        Route::get('/user/delete/acc_id/instalment_force/{id}',[UserController::class, 'delete_instalment_force'])->name('delete_instalment_force');
        Route::get('/loan/confirm/{id}',[LoanController::class, 'confirm'])->name('loan_confirm');
        Route::get('/payment/confirm/{id}',[PaymentController::class, 'confirm'])->name('payment_confirm');
        Route::get('/notification/delete/{id}',[NotificationController::class, 'delete'])->name('notification_delete');
        Route::post('/notification/create',[NotificationController::class, 'create'])->name('notification_create');
        Route::get('/expense/delete/{id}',[ExpenseController::class, 'delete'])->name('expense_delete');
        Route::post('/expense/create',[ExpenseController::class, 'create'])->name('expense_create');
        Route::get('/request/edit/{id}',[RequestController::class, 'form'])->name('request_form');
        Route::post('/request/edit/{id}',[RequestController::class, 'edit'])->name('request_edit');
        Route::get('/request',[RequestController::class, 'index'])->name('request');
        Route::get('/request/confirm/{id}',[RequestController::class, 'confirm'])->name('request_confirm');
    });
});