<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LoanApplicationController extends Controller
{
    // Show Loan Form
    public function create()
    {
        return view('loan.apply');
    }

    // Store Loan Application
    public function store(Request $request)
    {
        // Build rules dynamically: if user is logged in we can skip name/email required inputs
        $rules = [
            'tel' => 'required|string|max:15',
            'occupation' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'paysheet_uri' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
        ];

        if (!Auth::check()) {
            // for guests require name/email so we can still create a record
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
        }

        $request->validate($rules);

        // If user is authenticated, prefer their stored name/email and attach user_id
        $userId = null;
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $userId = $user->id;
        } else {
            $name = $request->name;
            $email = $request->email;
        }

        $filePath = null;
        if ($request->hasFile('paysheet_uri')) {
            $filePath = $request->file('paysheet_uri')->store('paysheets', 'public');
        }

        LoanApplication::create([
            'user_id' => $userId,
            'name' => $name,
            'email' => $email,
            'tel' => $request->tel,
            'occupation' => $request->occupation,
            'salary' => $request->salary,
            'paysheet_uri' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Loan application submitted successfully!');
    }

    // View PDF file
    public function viewPdf($id)
    {
        $loan = LoanApplication::findOrFail($id);

        if (!$loan->paysheet_uri) {
            abort(404, 'File not found');
        }

        $filePath = storage_path('app/public/' . $loan->paysheet_uri);
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
    }

    // Download PDF file
    public function downloadPdf($id)
    {
        $loan = LoanApplication::findOrFail($id);

        if (!$loan->paysheet_uri) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($loan->paysheet_uri);
    }

    // Approve loan
    public function approve($id)
    {
        $loan = LoanApplication::findOrFail($id);
        $loan->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Loan application approved!');
    }

    // Reject loan
    public function reject($id)
    {
        $loan = LoanApplication::findOrFail($id);
        $loan->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Loan application rejected!');
    }

    // Update Loan Application
    public function edit($id)
    {
        $loan = LoanApplication::findOrFail($id);
        return view('loan.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'required|string|max:15',
            'occupation' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'paysheet_uri' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
        ]);

        $loan = LoanApplication::findOrFail($id);

        // If new file uploaded → delete old one
        if ($request->hasFile('paysheet_uri')) {
            if ($loan->paysheet_uri && Storage::disk('public')->exists($loan->paysheet_uri)) {
                Storage::disk('public')->delete($loan->paysheet_uri);
            }
            $filePath = $request->file('paysheet_uri')->store('paysheets', 'public');
        } else {
            $filePath = $loan->paysheet_uri;
        }

        $loan->update([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'occupation' => $request->occupation,
            'salary' => $request->salary,
            'paysheet_uri' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Loan application updated successfully!');
    }

    // delete loan
    public function destroy($id)
    {
        $loan = LoanApplication::findOrFail($id);

        // Delete attached PDF or image
        if ($loan->paysheet_uri && Storage::disk('public')->exists($loan->paysheet_uri)) {
            Storage::disk('public')->delete($loan->paysheet_uri);
        }

        $loan->delete();

        return redirect()->back()->with('success', 'Loan application deleted successfully!');
    }



    public function index(Request $request)
    {
        $user = Auth::user();

        // If you want admins to see all applications, add role check here.
        // For now only the logged-in user's loans:
        $loans = LoanApplication::where('user_id', $user->id)
            ->latest()
            ->paginate(9); // 9 cards per page

        return view('loan.index', compact('loans'));
    }
}
