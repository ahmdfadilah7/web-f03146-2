@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<section class="notif">
    <div class="container">
        <div class="notif-header">
            <div class="image">
                <img src="{{ url('images/user.png') }}" class="img-fluid">
            </div>
            <h1 class="font-new-rocker text-uppercase text-white">Anonymous</h1>
        </div>
        <div class="notif-content">

            @if($like->count() == 0 && $comment->count() == 0)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <p class="font-new-rocker f-s-30 mt-2">Nofication not found.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @foreach($like->get() as $row)                
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="{{ url('images/user.png') }}" style="width: 50px;">                                        
                                </div>
                                <div class="col-md-11">
                                    <p class="font-new-rocker f-s-20 mt-2">Someone liked your story.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($comment->get() as $row)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="{{ url('images/user.png') }}" style="width: 50px;">                                        
                                </div>
                                <div class="col-md-11">
                                    <p class="font-new-rocker f-s-20 mt-2">Someone commented your story.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection