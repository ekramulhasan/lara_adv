<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-module');
        $module_data = Module::select(['id','module_name','module_slug','updated_at'])->latest()->get();
        // $module_data =  DB::table('modules')->select(['id','module_name','module_slug','updated_at'])->get();
        return view('admin.page.module.module_index',compact('module_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-module');
        return view('admin.page.module.module_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'module_name' => 'required|string|max:255'
        ]);

        Module::create([

            'module_name' => $request->module_name,
            'module_slug' => Str::slug($request->module_name)

        ]);

        // DB::table('modules')->insert([

        //     'module_name' => $request->module_name,
        //     'module_slug' => Str::slug($request->module_name)

        // ]);

        Toastr::success('successfully added module');
        return redirect()->route('module.index');
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
        Gate::authorize('edit-module');
        $module_name = Module::select('id','module_name')->find($id);
        return view('admin.page.module.module_edit',compact('module_name'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-module');
        $request->validate([
            'module_name' => 'required|string|max:255'
        ]);

       $module_data = Module::find($id);

       $module_data->update([

        'module_name' => $request->module_name,
        'module_slug' => Str::slug($request->module_name)

       ]);


       Toastr::success('successfully update module');
       return redirect()->route('module.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-module');
        // return $id;
        $module_data = Module::find($id);
        $module_data->delete();
        // DB::table('modules')->where('id',$id)->delete();
        Toastr::success('delete this item');
        return redirect()->route('module.index');
    }
}
