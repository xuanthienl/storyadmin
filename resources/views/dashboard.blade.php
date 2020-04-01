@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fas fa-th"></i> Dashboard</h5>
@endsection

@section('content')
    <br>
    @if (session('updateprofile'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <b> {{session('updateprofile')}}</b>
    </div>
    @endif

    @if (session('done'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info!</strong> <b> {{session('done')}}</b>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body clearfix p-0">
            <div class="float-left card-title p-2"><i class="fas fa-file-alt fa-2x"></i></div>
            <div class="text-right float-right p-2">
                <h4 class="card-title">{{count($stories)}}</h4>
                <p class="card-text"> Stories</p>
            </div>
            </div>
            <div class="card-footer bg-info p-0"><a href="{{ route('stories.create') }}" class="btn btn-md btn-info btn-block rounded-bottom p-2">Add Story</a></div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body clearfix p-0">
            <div class="float-left card-title p-2"><i class="fas fa-th-large fa-2x"></i></div>
            <div class="text-right float-right p-2">
                <h4 class="card-title">{{count($categories)}}</h4>
                <p class="card-text"> Categories</p>
            </div>
            </div>
            <div class="card-footer bg-info p-0"><a href="{{ route('categories.create') }}" class="btn btn-md btn-info btn-block rounded-bottom p-2">Add Category</a></div>
        </div>
        </div>
    </div><!-- end row  -->

@endsection