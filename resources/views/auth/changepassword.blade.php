@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

    <section class="login-form">
        <div class="container">
            <h1 class="font-nerko-one text-uppercase">{{ $setting->nama_website }}</h1>
            {!! Form::open(['method' => 'post', 'route' => ['prosesChangepassword']]) !!}
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly>
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
                    <button type="submit" class="btn btn-custom font-nerko-one">Change Password</button>
                </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection