<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user_data = User::with('userRole:id,role_name,role_slug')->select('id','role_id','name','email','is_active','created_at')->latest()->paginate(10);
        // return $user_data;
        return view('admin.page.user.user_index',compact('user_data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role_data = Role::select('id','role_name','role_slug')->get();
        return view('admin.page.user.user_create',compact('role_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {

        $request->validate([

            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|string|max:255',
            'user_password' => 'required|string|min:5'

        ]);


        User::updateOrCreate([

            'role_id' => $request->role_id,
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => Hash::make($request->user_password)

        ]);

        Toastr::success('successfully create user');
        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_update = User::find($id);
        $role_data = Role::select('id','role_name','role_slug')->get();
        // return $user_update;
        return view('admin.page.user.user_edit',compact('user_update','role_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $edit_user = User::find($id);

        $request->validate([

            'role_id'     => 'required|numeric',
            'user_name'   => 'required|string|max:255',
            'user_email'  => 'required|email|string|max:255',

        ]);


        $edit_user->update([

            'role_id' => $request->role_id,
            'name' => $request->user_name,
            'email' => $request->user_email,

        ]);


        Toastr::success('successfully update user');
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::find($id);
        $user->delete();

        Toastr::success('successfully delete user');
        return redirect()->route('user.index');

    }


    public function userActive($userId){

        $user = User::find($userId);

        if ($user->is_active == 1) {
           $user->is_active = 0;
        }
        else {
            $user->is_active = 1;
        }

        $user->update();
        return response()->json([
            'type' => 'success',
            'message' => 'status update'
        ]);

    }
}
