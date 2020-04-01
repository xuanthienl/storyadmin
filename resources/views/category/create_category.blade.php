@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fas fa-object-group"></i> Add Category</h5>
@endsection

@section('content')

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value={{csrf_token()}}>

        <div class="form-group">
            <label for="">Name:</label>
            <div><textarea name="name" cols="100%" rows="1" placeholder=" Category Name" required></textarea></div>
            @if ($errors->has('name'))
            <p class="alert alert-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="">IMAGE: </label>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" required>
        </div>
        <button type="submit" class="btn btn-info font-weight-bold">Create Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary" role="button">Close</a>
    </form>

@endsection    