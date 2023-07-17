<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('backend.pages.auth.loginForm');
    }



    public function loginProcess(Request $request)
{
dd($request->all());

    $credentials = $request->only(['email', 'password']);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role == 'customer') {
            return redirect()->route('home');
        }
    }

    // Authentication failed
    return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);
}

}
