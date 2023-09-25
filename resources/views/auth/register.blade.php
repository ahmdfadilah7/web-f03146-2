@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

    <section class="login-form">
        <div class="container">
            <h1 class="font-nerko-one text-uppercase">{{ $setting->nama_website }}</h1>
            {!! Form::open(['method' => 'post', 'route' => ['prosesRegister']]) !!}
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    <i class="text-danger font-nerko-one">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">No Handphone</label>
                    <input type="number" name="no_hp" class="form-control" placeholder="No Handphone" value="{{ old('no_hp') }}">
                    <i class="text-danger font-nerko-one">{{ $errors->first('no_hp') }}</i>
                </div>
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <i class="text-danger font-nerko-one">{{ $errors->first('password') }}</i>
                </div>
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Password Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                    <i class="text-danger font-nerko-one">{{ $errors->first('password') }}</i>
                </div>
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-custom font-nerko-one">Register</button>
                </div>
                <div class="form-group mb-4">
                    <p class="font-nerko-one">I have an account? <a href="{{ route('login') }}" class="forgot-password text-uppercase">Login</a></p>
                </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection