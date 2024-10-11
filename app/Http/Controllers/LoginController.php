<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view('login', ["active" => "login"]);
    }

    public function authenticate(Request $request){
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

     
        if (Auth::user()->role == 'admin') {
            return redirect()->intended('/admin'); 
        }
        

        
        return redirect()->intended('/dashboard');
    }

    return back()->with('Gagal', 'Login Gagal!')->withInput();
}
public function logout(Request $request)
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/login');
}
}

