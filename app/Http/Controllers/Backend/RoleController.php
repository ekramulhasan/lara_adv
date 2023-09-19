<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-role');
        $role_data = Role::with('permissions:id,module_id,permission_slug')->select(['id','role_name','updated_at'])->get();

        return view('admin.page.role.role_index',compact('role_data'));

        // return $role_data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-role');
        $module_data = Module::with('permissions:id,module_id,permission_name')->select('id','module_name')->get();
        return view('admin.page.role.role_create',compact('module_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'role_name' => 'required|string',
            'role_note' => 'nullable|string|max:255',
            'items'     => 'required|array',
            'items.*'   => 'numeric'
        ]);


        Role::updateOrCreate([

            'role_name' => $request->role_name,
            'role_slug' => Str::slug($request->role_name),
            'role_note' => $request->role_note,

        ])->permissions()->sync($request->input('items',[]));

        Toastr::success('successfully create role');
        return redirect()->route('role.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-role');
        $role_data   = Role::with('permissions')->find($id);
        $module_data = Module::with('permissions:id,module_id,permission_name')->select('id','module_name')->get();

        return view('admin.page.role.role_edit',compact('role_data','module_data'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-role');

        $role_update = Role::find($id);

        $role_update->update([

            'role_name' => $request->role_name,
            'role_slug' => Str::slug($request->role_name),
            'role_note' => $request->role_note,

        ]);

        $role_update->permissions()->sync($request->input('items',[]));

        Toastr::success('successfully update role');
        return redirect()->route('role.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Gate::authorize('delete-role');
       $role_delete = Role::find($id);

       if ($role_delete->is_deletable) {

            $role_delete->delete();
            Toastr::success('successfully delete role');
            return redirect()->route('role.index');

       }

       else {

        Toastr::error('can not delete this item');
        return redirect()->route('role.index');


       }


    }


    // public function restoreData($id){

    //     $restore_data = Role::withTrashed()->find($id);
    //     $restore_data->restore();

    //     Toastr::success('successfully restore role');

    // }
}
