<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryDivisionController;
use App\Http\Controllers\HistoryPositionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaidLeaveController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\WarningLetterController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', [HomeController::class, 'landingpage'])->name('landingpage');

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('division', DivisionController::class);
    Route::resource('position', PositionController::class);
    Route::resource('rule', RuleController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('paidleave', PaidLeaveController::class);
    Route::resource('warningletter', WarningLetterController::class);
    Route::resource('historyposition', HistoryPositionController::class);
    Route::resource('historydivision', HistoryDivisionController::class);
});
