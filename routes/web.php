<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailLogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RequestToApiLogController;
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

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::resource('cities', CityController::class);
Route::resource('branches', BranchController::class);
Route::resource('holidays', HolidayController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('employees', EmployeeController::class);

Route::get('request-to-api-log/', [RequestToApiLogController::class, 'index'])->name('request-to-api-log.index');

Route::get('cron/check-birthday', [CronController::class, 'checkBirthday'])->name('cron.check-birthday');

Route::get('email-log/', [EmailLogController::class, 'index'])->name('email-log.index');
Route::get('email-log/{id}/show', [EmailLogController::class, 'show'])->name('email-log.show');

Route::get('api/', [ApiController::class, 'index'])->name('api.index');
Route::post('api/store', [ApiController::class, 'store'])->name('api.store');

Route::get('email/', array(EmailController::class, 'index'))->name('email.index');
Route::post('email/store', array(EmailController::class, 'store'))->name('email.store');
