<?php

namespace App\Http\Controllers;

use App\Models\JobProvider;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function getShowAbout()
    {
        return view('About.about');
    }
    public function getShowAboutt()
    {
        return view('About.about2');
    }
    public function getShowAboutPerusahaan()
    {
        return view('About.aboutperusahaan');
    }
}
