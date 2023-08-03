<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::resource('emails', EmailController::class);
Route::resource('locations', LocationController::class);
Route::resource('request-types', HolidayController::class);
Route::resource('holidays', HolidayController::class);
Route::resource('departments', DepartmentController::class);
