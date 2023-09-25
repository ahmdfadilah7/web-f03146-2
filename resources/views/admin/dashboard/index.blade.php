@extends('admin.layouts.app')
@include('admin.layouts.partials.css')
@include('admin.layouts.partials.js')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Pengguna</h4>
                    </div>
                    <div class="card-body">
                        {{ $jumlahpengguna }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-warning bg-warning">
                    <i class="fas fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Story</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalstory }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
