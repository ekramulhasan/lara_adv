<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontendContorller extends Controller
{

    public function index($page_slug){

        $page = Page::findByslug($page_slug);
        return view('admin.page.frontend_page.about_us',compact('page'));


    }
}
