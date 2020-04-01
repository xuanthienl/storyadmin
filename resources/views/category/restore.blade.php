@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fas fa-object-group"></i> Category</h5>
@endsection

@section('content')

    <div class="container-fluid">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $category)
                <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->img }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <div style="color:white;" class="d-flex mt-2">
                        <form action="{{ route('postrestore', $category->id) }}" method ="GET">
                            <button type="submit" class="btn btn-info"><i class="far fa-edit"></i>Restore</button>
                        </form>
                        <form action="{{ route('delete', $category->id) }}" method ="GET">
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn Category {{ $category->name }} không !')" class="btn btn-dark ml-3"><i class="far fa-edit"></i>Force Delete</button> 
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