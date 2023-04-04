<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryDivisionController;
use App\Http\Controllers\HistoryPositionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HrdDashboardController;
use App\Http\Controllers\PaidLeaveController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\StaffPaidLeaveController;
use App\Http\Controllers\WarningLetterController;
use App\Models\WarningLetter;
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
    Route::get('profile', [EmployeeController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [EmployeeController::class, 'saveProfile'])->name('profile.update');

    Route::group(['middleware' => ['staff']], function () {
        Route::prefix('Staff')->name('Staff.')->group(function () {
            Route::get('/', [StaffDashboardController::class, 'index'])->name('Staff');
            Route::get('staffpaidleave/pdf/{paidleave}',  [StaffPaidLeaveController::class, 'pdf'])->name('staffpaidleave.pdf');
            Route::get('warningletter/history',  [WarningLetterController::class, 'history'])->name('warningletter.history');
            Route::get('warningletter/{warningletter}',  [WarningLetterController::class, 'show'])->name('warningletter.show');
            Route::resource('staffpaidleave', StaffPaidLeaveController::class);
        });
    });

    Route::group(['middleware' => ['hrd']], function () {
        Route::prefix('HRD')->name('HRD.')->group(function () {
            Route::get('/', [HrdDashboardController::class, 'index'])->name('HRD');
            Route::resource('employee', EmployeeController::class);
            Route::get('staffpaidleave/pdf/{paidleave}',  [StaffPaidLeaveController::class, 'pdf'])->name('staffpaidleave.pdf');
            Route::resource('staffpaidleave', StaffPaidLeaveController::class);
            Route::get('/paidleave/massleave', [PaidLeaveController::class, 'massLeave'])->name('paidleave.massLeave');
            Route::post('/paidleave/storeMassLeave', [PaidLeaveController::class, 'storeMassLeave'])->name('paidleave.storeMassLeave');
            Route::resource('paidleave', PaidLeaveController::class);
            Route::get('/paidleave/{paidleave}/detail', [PaidLeaveController::class, 'detail'])->name('paidleave.detail');
            Route::put('/paidleave/approval/{id}',[PaidLeaveController::class, 'approval'])->name('paidleave.approval');
            Route::put('/paidleave/disapprove/{id}',[PaidLeaveController::class, 'disapprove'])->name('paidleave.disapprove');
            Route::resource('warningletter', WarningLetterController::class);
            Route::resource('historyposition', HistoryPositionController::class);
            Route::resource('historydivision', HistoryDivisionController::class);
        });
    });


    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('Admin')->name('Admin.')->group(function () {
            Route::put('employee/{user}', [EmployeeController::class, 'reset'])->name('employee.reset');
            Route::get('/', [AdminDashboardController::class, 'index'])->name('Admin');
            Route::get('/paidleave/massleave', [PaidLeaveController::class, 'massLeave'])->name('paidleave.massLeave');
            Route::post('/paidleave/storeMassLeave', [PaidLeaveController::class, 'storeMassLeave'])->name('paidleave.storeMassLeave');
            Route::resource('paidleave', PaidLeaveController::class);
            Route::get('/paidleave/{paidleave}/detail', [PaidLeaveController::class, 'detail'])->name('paidleave.detail');
            Route::put('/paidleave/approval/{id}',[PaidLeaveController::class, 'approval'])->name('paidleave.approval');
            Route::put('/paidleave/disapprove/{id}',[PaidLeaveController::class, 'disapprove'])->name('paidleave.disapprove');
            Route::resource('warningletter', WarningLetterController::class);
            Route::resource('historyposition', HistoryPositionController::class);
            Route::resource('historydivision', HistoryDivisionController::class);
            Route::resource('division', DivisionController::class);
            Route::resource('position', PositionController::class);
            Route::resource('rule', RuleController::class);
            Route::resource('company', CompanyController::class);
            Route::resource('employee', EmployeeController::class);
        });
    });
});
