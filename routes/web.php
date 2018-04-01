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

//Auth Routes
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::Post('/login','Auth\LoginController@login');
Route::Post('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('register')          ->middleware('SuperAdminAuth');
Route::Post('/register','Auth\RegisterController@register')                                       ->middleware('SuperAdminAuth');
Route::get('/reregister/{id}','ReregisterController@edit')->name('reregister')                    ->middleware('SuperAdminAuth');
Route::Post('/reregister/{id}','ReregisterController@reregister')                                 ->middleware('SuperAdminAuth');


Route::get('/home', 'TransactionsController@index')->name('home')                                 ->middleware('auth');
Route::get('/admin', 'AdminController@index')->name('admin')                                      ->middleware('AdminAuth');
Route::get('/admin/{id}', 'AdminController@user')->name('user')                                   ->middleware('AdminAuth');
Route::post('/home', 'TransactionsController@create')->name('home')                               ->middleware('auth');
Route::get('/not_proved', 'AdminController@not_proved')->name('not_proved')                       ->middleware('AdminAuth');
Route::get('/notes', 'AdminController@notes')->name('notes')                                      ->middleware('AdminAuth');

Route::get('/transaction/{id}', 'TransactionsController@edit')->name('transaction')               ->middleware('SuperAdminAuth');
Route::post('/transaction/{id}', 'TransactionsController@restore')                                ->middleware('SuperAdminAuth');
Route::get('/delete/{id}', 'TransactionsController@delete')->name('delete')                       ->middleware('SuperAdminAuth');

Route::get('/user/register','Auth\RegisterController@showRegistrationForm')->name('register')          ->middleware('SuperAdminAuth');
Route::Post('/user/register','Auth\RegisterController@register')                                       ->middleware('SuperAdminAuth');

Route::get('/user/edit/{id}','UserController@edit')->name('user_edit')                                 ->middleware('SuperAdminAuth');
Route::Post('/user/edit/{id}','UserController@user_edit')                                              ->middleware('SuperAdminAuth');


Route::get('/home', 'HomeController@index')->name('home')                                              ->middleware('auth');
Route::post('/home', 'HomeController@create')->name('home')                                            ->middleware('auth');
Route::get('/admin/{id}', 'AdminController@user')->name('user')                                        ->middleware('AdminAuth');
Route::get('/admin', 'AdminController@index')->name('admin')                                           ->middleware('AdminAuth');
Route::get('/not_proved', 'AdminController@not_proved')->name('not_proved')                            ->middleware('AdminAuth');
Route::get('/notes', 'AdminController@notes')->name('notes')                                           ->middleware('AdminAuth');

Route::get('/transaction/{id}', 'HomeController@edit')->name('transaction')                            ->middleware('SuperAdminAuth');
Route::post('/transaction/{id}', 'HomeController@restore')                                             ->middleware('SuperAdminAuth');
Route::get('/delete/{id}', 'HomeController@delete')->name('delete')                                    ->middleware('SuperAdminAuth');