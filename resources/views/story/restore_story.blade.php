@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fas fa-object-group"></i> Story</h5>
@endsection

@section('content')

    <div class="container-fluid mt-5">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Title</th>
                    <th>Audio</th>
                    <th>Image</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($story as $story)
                <tr>
                <td>{{ $story->id }}</td>
                <td>{{ $story->category->name }}</td>
                <td>{{ $story->title }}</td>
                <td>{{ $story->audio }}</td>
                <td>{{ $story->img }}</td>
                <td>
                    <div style="color:white;" class="d-flex mt-2">
                        <form action="{{ route('restore_story', $story->id) }}" method ="GET">
                            <button type="submit" class="btn btn-info"><i class="far fa-edit"></i>Restore</button>
                        </form>
                        <form action="{{ route('delete_story', $story->id) }}" method ="GET">
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn Story {{ $story->title }} không ?')" class="btn btn-dark ml-3"><i class="far fa-edit"></i>Force Delete</button> 
                            <!-- XÓA VĨNH VIỄN -->
                        </form>
                    </div>
                </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

@endsection