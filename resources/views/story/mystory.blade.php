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

                    @foreach ($story as $row)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group row mb-2">
                                    <div class="col-md-1 col-sm-12 text-center">
                                        <img src="{{ url('images/user.png') }}" class="img-fluid">                                        
                                    </div>
                                    <div class="col-md-11">
                                        <textarea class="form-control" rows="3" placeholder="Create your story" readonly>{{ $row->story }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row text-left">
                                    <div class="col-md-1 col-sm-12 text-center"></div>
                                    <div class="col-md-11 d-flex">
                                        @php
                                            $like = \App\Models\Like::where('story_id', $row->id);
                                            $jum_like = $like->count();
                                            $liked = '';
                                            foreach ($like->get() as $value) {
                                                if ($value->user_id == Auth::guard('pengguna')->user()->id) {
                                                    $liked .= 'liked';
                                                }
                                            }
                                            $comment = \App\Models\Comment::where('story_id', $row->id);
                                            $jum_comment = $comment->count();
                                        @endphp
                                        @if($liked == 'liked')
                                            <p class="font-new-rocker f-s-10">
                                                <i class="fa fa-heart text-danger f-s-20"></i> {{ $jum_like }} Like
                                            </p>
                                        @else
                                            <a href="{{ route('story.like', $row->id) }}" class="font-new-rocker f-s-10 text-n-decor text-black"><i class="fa-regular fa-heart text-danger f-s-20"></i> {{ $jum_like }} Like</a>
                                        @endif
                                        <a href="javascript:void(0)" id="showComment{{ $row->id }}" class="ml-2 font-new-rocker f-s-10 text-n-decor text-black"><i class="fa-regular fa-comment f-s-20 text-primary"></i> {{ $jum_comment }} Comment</a>
                                        @if(Auth::guard('pengguna')->user()->id == $row->user_id)
                                            <i class="text-success font-new-rocker ml-2">My Story</i>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group" id="commentForm{{ $row->id }}">
                                    <div class="container">

                                        <form action="javascript:void(0)" id="createForm{{ $row->id }}">
                                            @csrf
                                            <input type="hidden" name="story_id" value="{{ $row->id }}">
                                            <div class="row mt-2">
                                                <div class="col-md-1 col-sm-12 text-center">
                                                    <img src="{{ url('images/user.png') }}" class="img-fluid">
                                                </div>
                                                <div class="col-md-11">
                                                    <textarea name="comment" class="form-control" rows="3" placeholder="Create your comment"></textarea>
                                                    <button type="submit" id="createComment{{ $row->id }}" class="btn btn-custom font-nerko-one mt-2">Post</button>
                                                    <a href="javascript:void(0)" id="closeComment{{ $row->id }}" class="btn btn-custom font-nerko-one mt-2">Close</a>
                                                </div>
                                            </div>
                                        </form>

                                        @foreach($comment->get() as $value)                                            
                                            <div class="row mt-2">
                                                <div class="col-md-1 col-sm-12 text-center">
                                                    <img src="{{ url('images/user.png') }}" class="img-fluid">
                                                </div>
                                                <div class="col-md-11 text-left">
                                                    <textarea class="form-control" rows="3" placeholder="Create your comment" readonly>{{ $value->comment }}</textarea>
                                                    <div class="d-flex">
                                                        @if(Auth::guard('pengguna')->user()->id == $value->user_id)
                                                            <i class="text-success font-new-rocker ml-2">My Comment</i>
                                                        @endif
                                                        <form action="javascript:void(0)" id="deleteForm{{ $row->id }}">
                                                            @csrf
                                                            <input type="hidden" name="comment_id" value="{{ $value->id }}">
                                                            <button type="submit" id="deleteComment{{ $row->id }}" class="btn btn-danger font-nerko-one btn-sm ml-2 mt-1"><i class="fa fa-trash"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            @foreach ($story as $row)
                document.getElementById('commentForm{{ $row->id }}').style.display = 'none';

                $('#showComment{{ $row->id }}').on('click', function () {
                    document.getElementById('commentForm{{ $row->id }}').style.display = 'block';
                });

                $('#closeComment{{ $row->id }}').on('click', function () {
                    document.getElementById('commentForm{{ $row->id }}').style.display = 'none';
                });

                $('#createComment{{ $row->id }}').on('click', function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('story.comment') }}',
                        type: 'POST',
                        data: $('#createForm{{ $row->id }}').serialize(),
                        success: function(response) {
                            if (response == 'success') {
                                window.location.reload();
                            }
                        }
                    });
                });

                $('#deleteComment{{ $row->id }}').on('click', function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('story.comment.delete') }}',
                        type: 'POST',
                        data: $('#deleteForm{{ $row->id }}').serialize(),
                        success: function(response) {
                            if (response == 'success') {
                                window.location.reload();
                            }
                        }
                    });
                });
            @endforeach
        })
    </script>

@endsection