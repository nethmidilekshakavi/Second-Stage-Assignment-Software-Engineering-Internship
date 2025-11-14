<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;

class LoanApplicationController extends Controller
{
    // Show Loan Form
    public function create()
    {
        return view('loan.apply'); // resources/views/loan/apply.blade.php
    }

    // Store Loan Application
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'required|string|max:15',
            'occupation' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'paysheet_uri' => 'nullable|mimes:pdf|max:2048',
        ]);

        $filePath = null;
        if($request->hasFile('paysheet_uri')){
            $filePath = $request->file('paysheet_uri')->store('paysheets', 'public');
        }

        LoanApplication::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'occupation' => $request->occupation,
            'salary' => $request->salary,
            'paysheet_uri' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Loan application submitted successfully!');
    }

    // Optional: List all loans
    public function index()
    {
        $loans = LoanApplication::all();
        return view('dashboard', compact('loans'));
    }
}
