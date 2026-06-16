<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors('Please login first.');
        }
        
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the admin's profile.
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors('Session expired. Please login again.');
        }

        $rules = [
            'username' => 'required|string|max:255|unique:admin,username,' . $admin->id,
            'email' => 'required|email|unique:admin,email,' . $admin->id,
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ];

        // Only validate password if it is provided
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
            $rules['current_password'] = 'required';
            
            $validated = $request->validate($rules);
            
            // Check current password
            if (!Hash::check($validated['current_password'], $admin->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.'])->onlyInput('current_password');
            }
            
            // Update password
            $admin->password = Hash::make($validated['password']);
        } else {
            $validated = $request->validate($rules);
        }

        // Update fields using your actual column names
        $admin->username = $validated['username'];
        $admin->email = $validated['email'];
        $admin->contact = $validated['contact'] ?? $admin->contact;
        $admin->address = $validated['address'] ?? $admin->address;
        $admin->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}