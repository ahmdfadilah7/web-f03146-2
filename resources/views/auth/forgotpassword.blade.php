@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

    <section class="login-form">
        <div class="container">
            <h1 class="font-nerko-one text-uppercase">{{ $setting->nama_website }}</h1>
            {!! Form::open(['method' => 'post', 'route' => ['prosesCheck']]) !!}
                <div class="form-group text-left mb-4">
                    <label for="" class="font-nerko-one">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <i class="text-danger font-nerko-one">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-custom font-nerko-one">Check</button>
                </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection