<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\SavingController;
use App\Http\Controllers\Admin\SavingTypeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\LoanCalculatorController;
use App\Http\Controllers\Member\LoanReportController;
use App\Http\Controllers\Member\MemberLoansController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\SavingsController;
use App\Http\Controllers\Member\SavingsReportController;
use App\Http\Controllers\Member\SharesController;
use App\Models\Loan;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/home', [DashboardController::class, 'index'])->name('home');


// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Logout Route
Route::any('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/lgas/{state}', function ($state) {
    return \App\Models\Lga::where('state_id', $state)
        ->where('status', 'active')
        ->get();
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {




    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Saving Types
    Route::resource('saving-types', SavingTypeController::class);

    // Savings Management
    Route::get('savings/bulk-create', [SavingController::class, 'bulkCreate'])->name('savings.bulk-create');
    Route::post('savings/bulk', [SavingController::class, 'bulkStore'])->name('savings.bulk.store');

    Route::resource('savings', SavingController::class);







    // Loan Types
    Route::resource('loan-types', LoanTypeController::class);

    // Loans Management
    Route::resource('loans', LoanController::class);
    Route::patch('loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');
    Route::patch('loans/{loan}/reject', [LoanController::class, 'reject'])->name('loans.reject');

    // Resources
    Route::resource('resources', ResourceController::class);

    // Members
    Route::resource('members', MemberController::class);
    Route::patch('members/{member}/approve', [MemberController::class, 'approve'])->name('members.approve');

    Route::patch('members/{member}/approve', [MemberController::class, 'approve'])->name('members.approve');
});

// Member routes
Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Savings Management
    Route::get('/savings', [SavingsController::class, 'index'])->name('savings.index');

    // Shares Management
    Route::get('/shares', [SharesController::class, 'index'])->name('shares.index');

    // Loan Calculator
    Route::get('/loans/calculator', [LoanCalculatorController::class, 'index'])->name('loans.calculator');
    Route::post('/loans/calculate', [LoanCalculatorController::class, 'calculate'])->name('loans.calculate');

    // Reports
    Route::get('/reports/savings', [SavingsReportController::class, 'index'])->name('reports.savings');
    Route::get('/reports/loans', [LoanReportController::class, 'index'])->name('reports.loans');


    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');


    //Loan
    Route::get('/loans', [MemberLoansController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [MemberLoansController::class, 'create'])->name('loans.create');
    Route::post('/loans', [MemberLoansController::class, 'store'])->name('loans.store');
    Route::get('/loans/{loan}', [MemberLoansController::class, 'show'])->name('loans.show');

    Route::post('/loan-calculator', [LoanCalculatorController::class, 'calculate'])
    ->name('loan.calculate');

    Route::get('/loan-calculator', [LoanCalculatorController::class, 'index'])->name('loan.calculator');
});




// API Routes
Route::get('/api/states/{state}/lgas', function ($state) {
    return \App\Models\Lga::where('state_id', $state)
        ->where('status', 'active')
        ->get();
});
