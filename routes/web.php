<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\ManagerAuth;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// --------------------------------------
// MAIN PAGES
// --------------------------------------
Route::get('/', function () {
    return view('login');
});

// --------------------------------------
// USER AUTH (Laravel Default Login/Register)
// --------------------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// --------------------------------------
// USER DASHBOARD & MANAGER DASHBOARD
// --------------------------------------
Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/user-dashboard', function () {
        return view('user-dashboard');
    })->name('user.dashboard');

    // Manager Dashboard (for users with manager role)
    Route::get('/dashboard', function () {
        $loans = \App\Models\LoanApplication::all();
        return view('dashboard', compact('loans'));
    })->name('dashboard');
});

// --------------------------------------
// SEPARATE MANAGER LOGIN (Hardcoded)
// --------------------------------------
Route::get('/manager-login', function () {
    return view('manager-login');
})->name('manager.login');

Route::post('/manager-login', function (Request $request) {
    $username = $request->username;
    $password = $request->password;

    if ($username === 'manager' && $password === 'mgr2025') {
        session(['manager_logged_in' => true]);
        return redirect()->route('manager.dashboard');
    }
    return back()->withErrors(['Invalid credentials']);
})->name('manager.login.submit');

Route::middleware([ManagerAuth::class])->group(function () {
    Route::get('/manager-dashboard', function () {
        $loans = \App\Models\LoanApplication::all();
        return view('dashboard', compact('loans'));
    })->name('manager.dashboard');

    Route::get('/manager/logout', function () {
        session()->forget('manager_logged_in');
        return redirect()->route('manager.login');
    })->name('manager.logout');

});

// --------------------------------------
// LOAN APPLICATION ROUTES
// --------------------------------------
Route::middleware(['auth'])->group(function () {
    // list page (you requested /loan/list in the request)
    Route::get('/loan/list', [LoanApplicationController::class, 'index'])->name('loan.index');

    // apply form + store
    Route::get('/loan/apply', [LoanApplicationController::class, 'create'])->name('loan.apply');
    Route::post('/loan', [LoanApplicationController::class, 'store'])->name('loan.store');

    // view / download paysheet (named routes used in the blade)
    Route::get('/loan/{id}/view', [LoanApplicationController::class, 'viewPdf'])->name('loan.view');
    Route::get('/loan/{id}/download', [LoanApplicationController::class, 'downloadPdf'])->name('loan.download');

    // edit / update / delete (if you have these methods)
    Route::get('/loan/{id}/edit', [LoanApplicationController::class, 'edit'])->name('loan.edit');
    Route::put('/loan/{id}', [LoanApplicationController::class, 'update'])->name('loan.update');
    Route::delete('/loan/{id}', [LoanApplicationController::class, 'destroy'])->name('loan.destroy');

    // admin actions (optional - protect with policies/middleware)
    Route::post('/loan/{id}/approve', [LoanApplicationController::class, 'approve'])->name('loan.approve');
    Route::post('/loan/{id}/reject', [LoanApplicationController::class, 'reject'])->name('loan.reject');
});
// Public PDF routes
Route::get('/loan/view-pdf/{id}', [LoanApplicationController::class, 'viewPdf'])->name('loan.pdf.view');
Route::get('/loan/download-pdf/{id}', [LoanApplicationController::class, 'downloadPdf'])->name('loan.pdf.download');


// Optional: View all applications (if needed)
Route::get('/loan/list', [LoanApplicationController::class, 'index'])->name('loan.index');
Route::get('/loan/approve/{id}', [LoanApplicationController::class, 'approve']);
Route::get('/loan/reject/{id}', [LoanApplicationController::class, 'reject']);
Route::get('/loan/view-pdf/{id}', [LoanApplicationController::class, 'viewPdf']);
Route::get('/loan/download-pdf/{id}', [LoanApplicationController::class, 'downloadPdf']);

// My Applications - only show loans of the authenticated user
