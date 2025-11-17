<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'nic_front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nic_back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'passport_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nicFrontPath = $request->file('nic_front_image')->store('nic_images', 'public');
        $nicBackPath = $request->file('nic_back_image')->store('nic_images', 'public');
        $passportPath = $request->file('passport_image')->store('passport_images', 'public');


        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'nic_front_image' => $nicFrontPath,
            'nic_back_image' => $nicBackPath,
            'passport_image' => $passportPath,
            'role' => 'user',
            'profile_completed' => true,
        ]);

        return redirect('/')->with('success', 'Registration successful! Please login.');
    }
}
