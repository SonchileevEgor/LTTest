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

Route::get('/admin', function () {
    return view('admin.requests.list');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/send-request', 'App\Http\Controllers\RequestController@create');
Route::post('/edit-request', 'App\Http\Controllers\RequestController@update');

Route::get('/add-request', 'App\Http\Controllers\RequestController@createForm');
Route::get('/delete-request/{req_id}', 'App\Http\Controllers\RequestController@delete');
Route::get('/update-request/{req_id}', 'App\Http\Controllers\RequestController@updateForm');
