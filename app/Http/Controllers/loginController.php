<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public function redirectToProvider($provider){

        return Socialite::driver($provider)->redirect();

    }

    public function providerCallback($provider){

        $user = Socialite::driver($provider)->user();
        $existingUser = User::whereEmail($user->getEmail())->first();

        if ($existingUser) {
          Auth::login($existingUser);
        }
        else {

         $newUser = User::updateOrCreate([

                'role_id' => Role::where('role_slug','user')->first()->id,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make(12345),
                'is_active' => true

            ]);

            Auth::login($newUser);
            

        }


        // return redirect($this->redirectPath());
        return redirect()->route('home');


    }



}
