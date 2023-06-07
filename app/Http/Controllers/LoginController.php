<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * View login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Check login
     */
    public function checkLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect(route('time_sheet.index'));
        }

        return back()->withErrors([
            'email' => __('message.Account information is incorrect')
        ])->onlyInput('email');
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
