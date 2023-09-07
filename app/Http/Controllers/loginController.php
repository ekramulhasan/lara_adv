<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(){


        return view('admin.page.login_page');

    }


    public function index(Request $request){


        // dd($request->all());
        $request->validate([

            'email' => 'bail|required|email|string|max:255',
            'password' => 'bail|required|string|max:5'

        ]);

        $cridentials = [

            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::attempt($cridentials)) {

            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([

            'email' => 'email is not valid',

        ])->onlyInput('email');

    }


    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.page');

    }
}
