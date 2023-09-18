<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index(){

        Gate::authorize('access-dashboard');
        return view('admin.layout.inc.home');

    }
}
