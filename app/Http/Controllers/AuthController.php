<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        $setting = Setting::first();

        return view('auth.login', compact('setting'));
    }

    // Menampilkan halaman register
    public function register()
    {
        $setting = Setting::first();

        return view('auth.register', compact('setting'));
    }

    // Menampilkan halaman forgot
    public function forgot()
    {
        $setting = Setting::first();

        return view('auth.forgotpassword', compact('setting'));
    }

    // Menampilkan halaman change_password
    public function change_password($email)
    {
        $setting = Setting::first();
        $user = User::where('email', $email)->first();

        return view('auth.changepassword', compact('user', 'setting'));
    }

    // Proses login
    public function proses_login(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $email = $request->get('email');
        $password = Hash::make($request->get('password'));
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $email)->first();
            if ($user->role == 'admin') {
                Auth::guard('admin')->loginUsingId($user->id);
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang '.Auth::user()->name);
            } elseif ($user->role == 'pengguna') {
                Auth::guard('pengguna')->loginUsingId($user->id);
                return redirect()->route('home')->with('success', 'Selamat datang di Anonymous Website');
            }
        } else {
            return back()->with('warning', 'Data yang dimasukkan tidak sesuai.');
        }
    }

    // Proses register
    public function proses_register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|numeric|unique:users,no_hp',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        User::create([
            'email' => $request->get('email'),
            'no_hp' => $request->get('no_hp'),
            'password' => Hash::make($request->get('password')),
            'role' => 'pengguna'
        ]);

        return redirect()->route('login')->with('success', 'Register Success.');
    }

    // Proses check
    public function proses_check(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }
        
        $email = $request->get('email');
        $user = User::where('email', $email);
        if ($user->count() > 0) {
            return redirect()->route('changepassword', $email)->with('success', 'Email Found');
        } else {
            return back()->with('warning', 'Email not found!!');
        }
    }

    // Proses Change Password
    public function proses_change_password(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }
        
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->get('password'));
        $user->save();
        
        return redirect()->route('login')->with('success', 'Change password success.');
    }

    // Proses logout
    public function logout($slug)
    {
        if ($slug == 'admin') {
            Auth::guard('admin')->logout();
        } elseif ($slug == 'pengguna') {
            Auth::guard('pengguna')->logout();
        }
        return redirect()->route('login')->with('success', 'Logout success.');
    }
}
