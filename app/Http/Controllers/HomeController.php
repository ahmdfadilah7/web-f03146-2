<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan halaman home
    public function index()
    {
        $setting = Setting::first();

        return view('home.index', compact('setting'));
    }
}
