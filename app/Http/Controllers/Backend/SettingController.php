<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function general()
    {

        return view('admin.page.settings.general');
    }

    public function general_update(Request $request)
    {

        $request->validate([

            'site_title' => 'required|string|max:255',
            'site_address' => 'required|string|max:255',
            'site_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'site_email' => 'required|string|email|max:255',
            'site_facebook_link' => 'required|string|max:255',
            'site_linkeding_link' => 'required|string|max:255',
            'site_description' => 'required|string|max:255',

        ]);



        Setting::updateOrCreate(

            ['name' => 'site_title'],
            ['value' => $request->site_title]

        );

        Setting::updateOrCreate(

            ['name' => 'site_address'],
            ['value' => $request->site_address]

        );

        Setting::updateOrCreate(

            ['name' => 'site_phone'],
            ['value' => $request->site_phone]

        );

        Setting::updateOrCreate(

            ['name' => 'site_email'],
            ['value' => $request->site_email]

        );

        Setting::updateOrCreate(

            ['name' => 'site_facebook_link'],
            ['value' => $request->site_facebook_link]

        );

        Setting::updateOrCreate(

            ['name' => 'site_linkeding_link'],
            ['value' => $request->site_linkeding_link]

        );

        Setting::updateOrCreate(

            ['name' => 'site_description'],
            ['value' => $request->site_description]

        );


        Toastr::success('setting successfully created');
        return back();
    }


    public function apperance()
    {

        return view('admin.page.settings.apperance');
    }

    public function apperance_update(Request $request)
    {

        $request->validate([

            'site_bg_color' => 'required|string|max:255',
            'logo_img'      => 'required|image|mimes:png,jpg',
            'favicon'       => 'nullable|image'

        ]);

        Setting::updateOrCreate(

            ['name' => 'site_bg_color'],
            ['value' => $request->site_bg_color]

        );

        if ($request->hasFile('logo_img')) {

            $upload_path = '/uploads/system_img';
            $file = $request->file('logo_img');
            $file_name = 'logo_img' . '.' . $file->extension(); //logo_img.jpg
            $old_path1 = 'public/uploads/system_img/' . $file_name;
            $this->deleteoldFile($old_path1);
            $request->logo_img->move(public_path($upload_path), $file_name);

            Setting::updateOrCreate(

                ['name'  => 'logo_img'],
                ['value' => $file_name]

            );


            if ($request->hasFile('favicon')) {

                $upload_path = '/uploads/system_img';
                $file_fav = $request->file('favicon');
                $fav_file_name = 'favicon' . '.' . $file_fav->extension(); //logo_img.jpg
                $old_path = 'public/uploads/system_img/' . $fav_file_name;
                $this->deleteoldFile($old_path);
                $request->favicon->move(public_path($upload_path), $fav_file_name);

                Setting::updateOrCreate(

                    ['name'  => 'favicon'],
                    ['value' => $fav_file_name]

                );
            }

            Toastr::success('successfully upload');
        }

        return back();
    }

    public function deleteoldFile($path)
    {

        unlink(base_path($path));
    }


    public function mail()
    {

        return view('admin.page.settings.mail');
    }

    public function mail_update(Request $request)
    {


        $request->validate([

            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|string',
            'mail_user' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'required|email|string'

        ]);


        Setting::updateOrCreate(

            ['name' => 'mail_mailer'],
            ['value' => $request->mail_mailer]

        );

        Setting::updateOrCreate(

            ['name' => 'mail_host'],
            ['value' => $request->mail_host]

        );

        Setting::updateOrCreate(

            ['name' => 'mail_port'],
            ['value' => $request->mail_port]

        );

        Setting::updateOrCreate(

            ['name' => 'mail_user'],
            ['value' => $request->mail_user]

        );

        Setting::updateOrCreate(

            ['name' => 'mail_password'],
            ['value' => $request->mail_password]

        );

        Setting::updateOrCreate(

            ['name' => 'mail_encryption'],
            ['value' => $request->mail_encryption]

        );

        Setting::updateOrCreate(

            ['name' => 'mail_from_address'],
            ['value' => $request->mail_from_address]

        );


        $envFilePath = base_path('.env');

        // Define the new values you want to set
        $newEnvValues = [

            "MAIL_MAILER=".$request->mail_mailer,
            "MAIL_HOST=".$request->mail_host,
            "MAIL_PORT=".$request->mail_port,
            "MAIL_USERNAME=".$request->mail_user,
            "MAIL_PASSWORD=".$request->mail_password,
            "MAIL_ENCRYPTION=".$request->mail_encryption,
            "MAIL_FROM_ADDRESS=".$request->mail_from_address
        ];

        // Read the current contents of the .env file
        $envContents = file_get_contents($envFilePath);

        // Update the .env contents with the new values
        foreach ($newEnvValues as $newEnvValue) {
            $envContents = preg_replace('/^' . preg_quote(explode('=', $newEnvValue)[0], '/') . '=.*/m', $newEnvValue, $envContents);
        }

        // Write the updated contents back to the .env file
        file_put_contents($envFilePath, $envContents);

        // You may also want to reload the configuration cache for Laravel to reflect the changes.
        // Artisan::call('config:cache');


        Toastr::success('successfully upload your data');
        return back();



    }

    public function socialiteView(){

        return view('admin.page.settings.socialite');

    }

    public function socialiteUpdate(Request $request){

        $request->validate([

            'github_client_id'        => 'required|string|max:255',
            'github_client_secret_id' => 'required|string|max:255',
            'github_redirect_url'     => 'required|string|max:255',
            'google_client_id'        => 'required|string|max:255',
            'google_client_secret_id' => 'required|string|max:255',
            'google_redirect_url'     => 'required|string|max:255',

        ]);


        Setting::updateOrCreate(

            ['name' => 'github_client_id'],
            ['value' => $request->github_client_id]

        );

        Setting::updateOrCreate(

            ['name' => 'github_client_secret_id'],
            ['value' => $request->github_client_secret_id]

        );

        Setting::updateOrCreate(

            ['name' => 'github_redirect_url'],
            ['value' => $request->github_redirect_url]

        );


        Setting::updateOrCreate(

            ['name' => 'google_client_id'],
            ['value' => $request->google_client_id]

        );

        Setting::updateOrCreate(

            ['name' => 'google_client_secret_id'],
            ['value' => $request->google_client_secret_id]

        );

        Setting::updateOrCreate(

            ['name' => 'google_redirect_url'],
            ['value' => $request->google_redirect_url]

        );



        $envFilePath = base_path('.env');

        // Define the new values you want to set
        $newEnvValues = [

            "GITHUB_CLIENT_ID=".$request->github_client_id,
            "GITHUB_CLIENT_SECRET=".$request->github_client_secret_id,
            "GITHUB_REDIRECT_URL=".$request->github_redirect_url,
            "GOOGLE_CLIENT_ID=".$request->google_client_id,
            "GOOGLE_CLIENT_SECRET=".$request->google_client_secret_id,
            "GOOGLE_REDIRECT_URL=".$request->google_redirect_url,

        ];

        // Read the current contents of the .env file
        $envContents = file_get_contents($envFilePath);

        // Update the .env contents with the new values
        foreach ($newEnvValues as $newEnvValue) {
            $envContents = preg_replace('/^' . preg_quote(explode('=', $newEnvValue)[0], '/') . '=.*/m', $newEnvValue, $envContents);
        }

        // Write the updated contents back to the .env file
        file_put_contents($envFilePath, $envContents);

        // You may also want to reload the configuration cache for Laravel to reflect the changes.
        // Artisan::call('config:cache');


        Toastr::success('successfully upload your data');
        return back();

    }


}
