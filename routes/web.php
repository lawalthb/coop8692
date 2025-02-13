<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDisputeController;
use App\Http\Controllers\Admin\AdminExpenseController;
use App\Http\Controllers\Admin\AdminGrantController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanRepaymentController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileUpdateRequestController;
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
use App\Http\Controllers\Member\MemberDisputeController;
use App\Http\Controllers\Member\MemberLoansController;
use App\Http\Controllers\Member\MemberNotificationController;
use App\Http\Controllers\Member\MemberProfileController;
use App\Http\Controllers\Member\MemberResourceController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\SavingsController;
use App\Http\Controllers\Member\SavingsReportController;
use App\Http\Controllers\Member\SharesController;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Support\Facades\Mail;
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

//Route::get('/home', [DashboardController::class, 'index'])->name('home');


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
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');


    Route::patch('members/{member}/approve', [MemberController::class, 'approve'])->name('members.approve');

    Route::get('/profile-updates', [ProfileUpdateRequestController::class, 'index'])->name('profile-updates.index');
    Route::get('/profile-updates/{request}', [ProfileUpdateRequestController::class, 'show'])->name('profile-updates.show');
    Route::post('/profile-updates/{request}/approve', [ProfileUpdateRequestController::class, 'approve'])->name('profile-updates.approve');
    Route::post('/profile-updates/{request}/reject', [ProfileUpdateRequestController::class, 'reject'])->name('profile-updates.reject');

    //transactions
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    // Disputes
    Route::get('/disputes', [AdminDisputeController::class, 'index'])->name('disputes.index');
    Route::post('/disputes/{dispute}/respond', [AdminDisputeController::class, 'respond'])->name('disputes.respond');


    //reports
    Route::get('/', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/members', [AdminReportController::class, 'members'])->name('reports.members');
    Route::get('/reports/savings', [AdminReportController::class, 'savings'])->name('reports.savings');
    Route::get('/reports/loans', [AdminReportController::class, 'loans'])->name('reports.loans');
    Route::get('/reports/transactions', [AdminReportController::class, 'transactions'])->name('reports.transactions');

    Route::get('/reports/members/export', [AdminReportController::class, 'exportMembers'])->name('reports.members.export');
    Route::get('/reports/loans/export', [AdminReportController::class, 'exportLoans'])->name('reports.loans.export');

    Route::get('/reports/transactions/export', [AdminReportController::class, 'exportTransactions'])->name('reports.transactions.export');

    //grant
    Route::get('/grants/create', [AdminGrantController::class, 'create'])->name('grants.create');
    Route::post('/grants', [AdminGrantController::class, 'store'])->name('grants.store');


    //repayment routes


    Route::post('loans/{loan}/repayment', [LoanRepaymentController::class, 'store'])->name('loans.repayments.store');

    //expenses routes
    Route::get('/expenses/create', [AdminExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [AdminExpenseController::class, 'store'])->name('expenses.store');



    //admins
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/admins/{admin}', [AdminController::class, 'show'])->name('admins.show');
    Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');


}); //end admin routes




// Member routes
Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Savings Management
    Route::get('/savings', [SavingsController::class, 'index'])->name('savings.index');

    // Shares Management
    Route::get('/shares', [SharesController::class, 'index'])->name('shares.index');

    // Loan Calculator
    Route::get('/loans/calculator', [LoanCalculatorController::class, 'index'])->name('loans.calculator');
    Route::post('/loans/calculate', [LoanCalculatorController::class, 'calculate'])->name('loans.calculate');

    // guarantor request

    Route::get('/member/guarantor-requests', [MemberLoansController::class, 'guarantorRequests'])
        ->name('loans.guarantor-requests');

    Route::get('/loans/guarantor/{id}', [MemberLoansController::class, 'show'])->name('loans.guarantor');


    Route::post('/loans/{loan}/guarantor/respond', [MemberLoansController::class, 'guarantorRespond'])
        ->name('loans.guarantor.respond');


    // Reports
    Route::get('/reports/savings', [SavingsReportController::class, 'index'])->name('reports.savings');
    Route::get('/reports/loans', [LoanReportController::class, 'index'])->name('reports.loans');




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

    Route::resource('resources', MemberResourceController::class)->only(['index', 'show']);
    Route::get('resources/{resource}/download', [MemberResourceController::class, 'download'])->name('resources.download');

    // Profile routes
    Route::get('/profile/show', [MemberProfileController::class, 'show'])->name('profile.show');


    Route::get('/profile', [MemberProfileController::class, 'index'])->name('profile.index');

    Route::post('/profile', [MemberProfileController::class, 'updateRequest'])->name('profile.update-request');


    Route::put('/profile', [MemberProfileController::class, 'update'])->name('profile.update');

    Route::get('/notifications', [MemberNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [MemberNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [MemberNotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    Route::post('/disputes', [MemberDisputeController::class, 'store'])->name('disputes.store');
    Route::get('/transactions', [MemberTransactionController::class, 'index'])->name('transactions.index');
}); //end of member routes




// API Routes
Route::get('/states/{state}/lgas', function ($state) {
    return \App\Models\Lga::where('state_id', $state)
        ->where('status', 'active')
        ->get();
});

Route::get('/mail', function () {
    Mail::raw('Test email content', function ($message) {
        $message->to('lawalthb@gmail.com')
            ->subject('Test Email');
    });

    return 'Test email sent successfully!';
});
