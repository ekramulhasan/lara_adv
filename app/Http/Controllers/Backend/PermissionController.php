<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-permission');
        $permission_data = Permission::with('module:id,module_name,module_slug')->select(['id','module_id','permission_name','permission_slug','updated_at'])->latest()->paginate();
        // return $permission_data;
        return view('admin.page.permission.permission_index',compact('permission_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-permission');
        $module_data = Module::select('id','module_name')->get();
        return view('admin.page.permission.permission_create',compact('module_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-permission');

        $request->validate([

            'module_id'       => 'required|numeric',
            'permission_name' => 'required|string|max:255'
        ]);

        Permission::updateOrcreate([

            'module_id'       => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name)

        ]);

        Toastr::success('successfully added permission');
        return redirect()->route('permission.index');


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
        Gate::authorize('edit-permission');
        $permission_name = Permission::select('id','module_id','permission_name')->find($id);
        $module_data = Module::select('id','module_name')->get();
        // return $permission_name;
        return view('admin.page.permission.permission_edit',compact('permission_name','module_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        Gate::authorize('edit-permission');

        $permission = Permission::find($id);

        $request->validate([
            'module_id' => 'required|numeric',
            'permission_name' => 'required|string|max:255'
        ]);

        $permission->update([

            'module_id' => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name)

        ]);

        Toastr::success('successfully added permission');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Gate::authorize('delete-permission');
        Permission::find($id)->delete();

        Toastr::success('successfully deleted!');
        return redirect()->route('permission.index');


    }
}
