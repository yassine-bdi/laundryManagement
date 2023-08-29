<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;

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
    return redirect(RouteServiceProvider::HOME);
});


Route::get('/home', '\App\Http\Controllers\DashboardController@home')->middleware(['auth', 'Language']);

Route::controller(ServiceController::class)->group(function () {
    Route::get('/services', 'Services')->name('services');
    Route::post('/newservice', 'addService')->name('addService');
    Route::patch('/serviceedit/{id}', 'editService')->name('editService');
    Route::delete('/servicedelete/{id}', 'deleteService')->name('deleteService');
});

Route::controller(LaundryController::class)->group(function () {
    Route::get('/laundries', 'Laundries')->name('laundries');
    Route::post('/addlaundry', 'addLaundries')->name('addlaundry');
    Route::patch('/editlaundry/{id}', 'editLaundries')->name('editlaundries');
    Route::delete('/laundrydelete/{id}', 'deleteLaundry')->name('deletelaundry');
});

Route::controller(priceController::class)->group(function () {
    Route::get('/prices', 'prices')->name('prices');
    Route::post('/addprice', 'addPrice')->name('addprice');
    Route::patch('/editprice/{id}', 'editPrice')->name('editprice');
    Route::delete('/pricedelete/{id}', 'deletePrice')->name('deleteprice');
});

Route::controller(workerController::class)->group(function () {
    Route::get('/workers', 'workers')->name('workers');
    Route::post('/addworker', 'addWorker')->name('addworker');
    Route::patch('/editworker/{id}', 'editWorker')->name('editworker');
    Route::delete('/workerdelete/{id}', 'deleteWorker')->name('deleteworker');
});

Route::controller(CommandController::class)->group(function () {
    Route::get('/commands', 'commands')->name('commands');
    Route::post('/addcommand', 'addCommand')->name('addcommand');
    Route::patch('/editcommand/{id}', 'editCommand')->name('editcommand');
    Route::delete('/deletecommand/{id}', 'deleteCommand')->name('deletecommand');
});


Route::get('/change-language/{lang}', "\App\Http\Controllers\HomeController@changeLang");

Route::controller(UserController::class)->group(function () {
    Route::get('profile/{user}', 'showProfile')->name('profile');
});

Route::fallback(function () {
    return view('404');
});
