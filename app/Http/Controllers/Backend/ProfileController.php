<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;



class ProfileController extends Controller
{
    public function getProfileUpdate(){

       $user = Auth::user();
       return view('admin.page.profile.update-profile',compact('user'));

    }

    public function updateProfile(Request $request){

        $request->validate([

            'user_name'  => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_img'   => 'nullable|image|mimes:png,jpg'

        ]);

        $user_id = User::whereEmail('admin@gmail.com')->first();
        $this->img_upload($request,$user_id->id);

        Toastr::success('successfully image upload');
        return back();

    }

    public function img_upload($request, $user_id){

        if ($request->hasFile('user_img')) {

            $user = User::find($user_id);

            if ($user->user_img != null) {

                $img_location = 'public/uploads/profile_img/';
                $old_img_loaction = $img_location.$user->user_img; //public/uploads/profile_img/1.jpg
                unlink(base_path($old_img_loaction));

            }

            $file_path = 'public/uploads/profile_img/';
            $img_file  = $request->file('user_img');
            $file_name = $user_id.'.'.$img_file->getClientOriginalExtension(); //1.jpg

            $new_file_path = $file_path.$file_name; //public/uploads/profile_img/1.jpg

            Image::make($img_file)->resize(600,600)->save(base_path($new_file_path));

            $user->update([

                'user_img' => $file_name,

            ]);
        }

    }
}
