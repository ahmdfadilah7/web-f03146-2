<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        $setting = Setting::first();
        $jumlahpengguna = User::where('role', 'pengguna')->count();
        $totalstory = Story::count();

        return view('admin.dashboard.index', compact('setting', 'jumlahpengguna', 'totalstory'));
    }
}
