<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{
    public function terms()
    {
        return view('terms');
    }

    public function policy()
    {
        return view('policy');
    }

    
    public function aboutus()
    {
        return view('about-us');
    }
}
