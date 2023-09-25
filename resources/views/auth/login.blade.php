@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

    <section class="login-form">
        <div class="container">
            <h1 class="font-nerko-one text-uppercase">{{ $setting->nama_website }}</h1>
            {!! Form::open(['method' => 'post', 'route' => ['prosesLogin']]) !!}
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <i class="text-danger font-nerko-one">{{ $errors->first('email') }}</i>
                </div>                
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @if($errors->first('password') <> '')
                        <i class="text-danger font-nerko-one">{{ $errors->first('password') }}</i>
                        <br>
                    @endif
                    <a href="{{ route('forgotpassword') }}" class="font-nerko-one forgot-password text-uppercase">Forgot Password?</a>
                </div>
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-custom font-nerko-one">Login</button>
                </div>
                <div class="form-group mb-4">
                    <p class="font-nerko-one">Don't have an account? <a href="{{ route('register') }}" class="forgot-password text-uppercase">Register</a></p>
                </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection