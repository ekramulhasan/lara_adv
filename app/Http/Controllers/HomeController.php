<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\UserLoginHistore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index(){

        Gate::authorize('access-dashboard');

        $user_count = User::count();
        $role_count = Role::count();
        $page_count = Page::count();
        $user_data = UserLoginHistore::latest('id')->paginate(10);

        return view('admin.layout.inc.home',compact(

            'user_count',
            'role_count',
            'page_count',
            'user_data'

        ));


    }
}
