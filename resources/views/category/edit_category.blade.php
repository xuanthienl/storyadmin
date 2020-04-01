@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fas fa-object-group"></i> Edit Category</h5>
@endsection

@section('content')
    <div class="row p-4">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value={{csrf_token()}}>

        <div class="form-group">
            <label for="">Name:</label>
            <div><textarea name="name" cols="100%" rows="1">{{ $category->name }}</textarea></div>
        </div>
        <div class="form-group">
            <label for="sound">Image File: </label>
            <img src="{{ asset('uploads/img/category/'.$category->img)}}" class="img-thumbnail" alt="" width="100" height="100">
            <br>
            <input type="file" name="image" value="{{ $category->img }}">
        </div>

        <button type="submit" class="btn btn-info font-weight-bold">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary" role="button">Close</a>
    </form>
    </div>

@endsection    