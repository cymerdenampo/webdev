<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Replace 'Tenant' with your tenant model if different

class AdminController extends Controller
{

    public function showLoginForm()
    {
        if (auth()->user()) {
            return redirect()->intended('/home');
        }
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to a property owner dashboard or other secure page
            $user = Auth::user();
            $role = $user->roles->first();
            if ($role && $role->name === 'admin') {
                return redirect()->intended('/home');
            }
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Your credentials are invalid');
        } else {
            // Authentication failed, redirect back to the login form with an error message
            return redirect()->route('admin.login')->with('error', 'Your credentials are invalid');
        }
    }
}
