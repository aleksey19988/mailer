<?php

use App\Http\Controllers\EmailController;
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

Route::get('/', [SiteController::class, 'index']);

Route::resource('emails', EmailController::class);

//Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
//Route::get('/emails/create', [EmailController::class, 'create'])->name('emails.create');
//Route::post('/emails', [EmailController::class, 'store'])->name('emails.store');
//Route::get('/emails/{email}', [EmailController::class, 'show'])->name('emails.show');
//Route::get('/emails/{email}/edit', [EmailController::class, 'edit'])->name('emails.edit');
//Route::put('/emails/{email}', [EmailController::class, 'update'])->name('emails.update');
//Route::delete('/emails/{email}', [EmailController::class, 'destroy'])->name('emails.destroy');
