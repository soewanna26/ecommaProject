<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'login' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $login = $request->input('login');

            $credentials = []; // Initialize empty array

            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $credentials = ['email' => $login];
            } else {
                $credentials = ['phone' => $login]; // Assuming phone number is stored without country code
            }

            // Include password explicitly
            $credentials['password'] = $request->password;

            if (Auth::guard('admin')->attempt($credentials)) {

                if(Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->back()->with('error', 'You are not authorized to access this page.');
                }
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials. Please check your email, phone number, or password.');
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
