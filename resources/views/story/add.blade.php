@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
    <section class="post">
        <div class="container-fluid">
            <div class="post-header">
                <div class="image">
                    <img src="{{ url('images/user.png') }}" class="img-fluid">
                </div>
                <h1 class="font-new-rocker text-uppercase text-white">Anonymous</h1>
            </div>
            <div class="post-content">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-2">
                        <a href="{{ route('story.mystory.add') }}" class="btn btn-custome-white d-block">Add</a>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <a href="{{ route('story.mystory') }}" class="btn btn-custome-white d-block">My Story</a>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <a href="{{ route('story') }}" class="btn btn-custome-white d-block">All Story</a>
                    </div>
                </div>
                <div class="container mt-4">
                    {!! Form::open(['method' => 'post', 'route' => ['story.store']]) !!}
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="{{ url('images/user.png') }}" class="img-fluid">
                                </div>
                                <div class="col-md-11">
                                    <textarea name="story" class="form-control" rows="3" placeholder="Create your story"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-custom font-nerko-one">Post</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
