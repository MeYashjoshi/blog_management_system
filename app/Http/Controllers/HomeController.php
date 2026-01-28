<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function showHome()
    {
            return view('frontend.index');
    }

    public function showDashboard()
    {
            return view('dashboard.index');
    }

    public function showAbout()
    {
            return view('frontend.about');
    }
    public function showContactus()
    {
            return view('frontend.contactus');
    }
}
