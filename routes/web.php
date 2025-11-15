<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\ManagerAuth;
use App\Http\Controllers\LoanApplicationController;

// -------------------------
// Manager Login Routes
// -------------------------
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', function(Request $request){
    $username = $request->username;
    $password = $request->password;

    if($username === 'manager' && $password === 'mgr2025') {
        session(['manager_logged_in' => true]);
        return redirect('/dashboard');
    } else {
        return back()->withErrors(['Invalid credentials']);
    }
})->name('login.submit');

// -------------------------
// Protected Manager Routes
// -------------------------
Route::middleware([ManagerAuth::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', function(){
        $loans = \App\Models\LoanApplication::all();
        return view('dashboard', compact('loans'));
    })->name('dashboard');

    // Approve / Reject Loan
    Route::get('/loan/approve/{id}', function($id){
        $loan = \App\Models\LoanApplication::findOrFail($id);
        $loan->status = 'approved';
        $loan->save();
        return redirect()->back();
    });

    Route::get('/loan/reject/{id}', function($id){
        $loan = \App\Models\LoanApplication::findOrFail($id);
        $loan->status = 'rejected';
        $loan->save();
        return redirect()->back();
    });

    // Logout
    Route::get('/logout', function(){
        session()->forget('manager_logged_in');
        return redirect('/login');
    });
});

// -------------------------
// Loan Application Web Routes
// -------------------------
Route::get('/loan/apply', [LoanApplicationController::class, 'create'])->name('loan.apply');
Route::post('/loan/apply', [LoanApplicationController::class, 'store'])->name('loan.store');

// Optional: View all applications (if needed)
Route::get('/loan/list', [LoanApplicationController::class, 'index'])->name('loan.index');
Route::get('/loan/approve/{id}', [LoanApplicationController::class, 'approve']);
Route::get('/loan/reject/{id}', [LoanApplicationController::class, 'reject']);
Route::get('/loan/view-pdf/{id}', [LoanApplicationController::class, 'viewPdf']);
Route::get('/loan/download-pdf/{id}', [LoanApplicationController::class, 'downloadPdf']);

// Edit loan
Route::get('/loan/{id}/edit', [LoanApplicationController::class, 'edit'])->name('loan.edit');

// Update loan
Route::put('/loan/{id}/update', [LoanApplicationController::class, 'update'])->name('loan.update');

// Delete loan
Route::delete('/loan/{id}/delete', [LoanApplicationController::class, 'destroy'])->name('loan.delete');
