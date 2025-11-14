<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\ManagerAuth;

Route::get('/login', function () {
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
});

Route::middleware([ManagerAuth::class])->group(function () {
    Route::get('/dashboard', function(){
        $loans = \App\Models\LoanApplication::all();
        return view('dashboard', compact('loans'));
    });

    Route::get('/loan/approve/{id}', function($id){
        $loan = \App\Models\LoanApplication::findOrFail($id);
        $loan->status = 'approved';
        $loan->save();
        return redirect('/dashboard');
    });

    Route::get('/loan/reject/{id}', function($id){
        $loan = \App\Models\LoanApplication::findOrFail($id);
        $loan->status = 'rejected';
        $loan->save();
        return redirect('/dashboard');
    });

    Route::get('/logout', function(){
        session()->forget('manager_logged_in');
        return redirect('/login');
    });
});
