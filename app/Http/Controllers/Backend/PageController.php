<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-page');
        $page_data = Page::select('id','page_title','meta_description','meta_key','is_active','created_at')->latest()->paginate();
        return view('admin.page.page_builder.page_index',compact('page_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-page');
        return view('admin.page.page_builder.page_create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Gate::authorize('create-page');
        $request->validate([


            'page_title'  => 'required|string|max:255|unique:pages',
            'page_slug'   => 'string|max:255|unique:pages',
            'meta_des'    => 'nullable|string|max:255',
            'meta_key'    => 'nullable|string|max:255',
            'page_short'  => 'nullable|string',
            'page_long'   => 'nullable|string',
            'page_img'    => 'nullable|image|mimes:png,jpg',

        ]);

        $page = Page::updateOrcreate([

            'page_title' => $request->page_title,
            'page_slug'  => $request->page_slug ?? Str::slug($request->page_title),
            'page_short' => $request->page_short,
            'page_long'  => $request->page_long,
            'meta_description' => $request->meta_des,
            'meta_key' => $request->meta_key,

        ]);

        // dd($request->all());
        $this->img_upload($request,$page->id);
        Toastr::success('successfully upload your page');
        return redirect()->route('page.index');
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
        Gate::authorize('edit-page');
        $page_data = Page::find($id);
        return view('admin.page.page_builder.page_edit',compact('page_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-page');
        $page = Page::find($id);

        $request->validate([


            'page_title'  => 'required|string|max:255',
            'page_slug'   => 'required|string|max:255',
            'meta_des'    => 'nullable|string|max:255',
            'meta_key'    => 'nullable|string|max:255',
            'page_short'  => 'nullable|string',
            'page_long'   => 'nullable|string',
            'page_img'    => 'nullable|image|mimes:png,jpg',

        ]);

        $page->update([

            'page_title' => $request->page_title,
            'page_slug'  => $request->page_slug ?? Str::slug($request->page_title),
            'page_short' => $request->page_short,
            'page_long'  => $request->page_long,
            'meta_description' => $request->meta_des,
            'meta_key' => $request->meta_key,

        ]);

        // dd($request->all());
        $this->img_upload($request,$page->id);
        Toastr::success('successfully update your page');
        return redirect()->route('page.index');

        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       Gate::authorize('delete-page');
       $page = Page::find($id);

       if ($page->page_img != null) {

        $upload_path = 'public/uploads/pages_img/';
        $file_path = $upload_path.$page->page_img;

        unlink(base_path($file_path));

       }

        $page->delete();

        Toastr::success('successfully delete your page');
        return redirect()->route('page.index');

    }


    public function pageActive($pageId){

        // Gate::authorize('page-isactive');

        $page = Page::find($pageId);

        if ($page->is_active == 1) {
           $page->is_active = 0;
        }
        else {
            $page->is_active = 1;
        }

        $page->update();
        return response()->json([
            'type' => 'success',
            'message' => 'status update'
        ]);
    }


    public function img_upload($request, $page_id){

        // Gate::authorize('profile-update');

        if ($request->hasFile('page_img')) {

            $page = Page::find($page_id);

            if ($page->page_img != null) {

                $img_location = 'public/uploads/pages_img/';
                $old_img_loaction = $img_location.$page->page_img; //public/uploads/profile_img/1.jpg
                unlink(base_path($old_img_loaction));

            }

            $file_path = 'public/uploads/pages_img/';
            $img_file  = $request->file('page_img');
            $file_name = $page_id.'.'.$img_file->getClientOriginalExtension(); //1.jpg

            $new_file_path = $file_path.$file_name; //public/uploads/profile_img/1.jpg

            Image::make($img_file)->save(base_path($new_file_path));

            $page->update([

                'page_img' => $file_name,

            ]);
        }

    }
}
