<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return 'todo bien';
            // return redirect()->intended('dashboard');
        }
 
        return 'The provided credentials do not match our records.';
    }

    public function user(){
        return Auth::user();
    }
}
