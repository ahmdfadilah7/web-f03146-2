@extends('admin.layouts.app')
@include('admin.layouts.partials.css')
@include('admin.layouts.partials.js')

@section('content')

    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.setting') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Setting Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('admin.setting') }}">Setting Website</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Setting Website</h4>
                </div>
                <div class="card-body">
                    {!! Form::model($setting, ['method' => 'post', 'route' => ['admin.setting.update', $setting->id], 'enctype' => 'multipart/form-data']) !!}
                    @method('PUT')
                    @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Website</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_website" class="form-control" value="{{ $setting->nama_website }}">
                            <i class="text-danger">{{ $errors->first('nama_website') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tagline</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="tagline" class="form-control" value="{{ $setting->tagline }}">
                            <i class="text-danger">{{ $errors->first('tagline') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Background Sebelumnya</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                <img src="{{ url($setting->gambar_background) }}" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Background</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview3" class="image-preview">
                                <label for="image-upload3" id="image-label3">Choose File</label>
                                <input type="file" name="gambar_background" id="image-upload3" />
                            </div>
                            <i class="text-danger">{{ $errors->first('gambar_background') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Favicon Sebelumnya</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                <img src="{{ url($setting->favicon) }}" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Favicon</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview2" class="image-preview">
                                <label for="image-upload2" id="image-label2">Choose File</label>
                                <input type="file" name="favicon" id="image-upload2" />
                            </div>
                            <i class="text-danger">{{ $errors->first('favicon') }}</i>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection