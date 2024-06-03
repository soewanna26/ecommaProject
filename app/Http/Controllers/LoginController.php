<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('account.login');
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

            if (Auth::attempt($credentials)) {
                return redirect()->route('account.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials. Please check your email, phone number, or password.');
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function register()
    {
        return view('account.register');
    }

    public function processRegister(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^\d+$/',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();
            return redirect()->route('account.login')->with('success', 'You have successfully registered');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
