@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

    <section class="home">
        <div class="container">
            <h1 class="font-new-rocker text-uppercase">{{ $setting->nama_website }}</h1>
            <p class="font-neucha text-uppercase">{{ $setting->tagline }}</p>
            @if(Auth::guard('pengguna')->user() == '')
                <div class="d-grid gap-2 d-md-block d-sm-block mt-5">
                    <a href="{{ route('login') }}" class="btn btn-custom font-nerko-one mr-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-custom font-nerko-one ml-3">Register</a>
                </div>
            @endif
        </div>
    </section>

@endsection