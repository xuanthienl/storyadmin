@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fas fa-object-group"></i> Category</h5>
@endsection

@section('content')

    <style>
        .pagination {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        }
    </style>

    <div>
        <div class="d-flex">
        <div class="py-3"></div>
        <div class="py-3"></div>
        <div class="ml-auto  pt-3 pb-3"><a class="btn btn-info" role="button" href="{{ route('categories.create') }}"> <i class="fas fa-plus-circle"></i> Add Catgory</a></div>
    </div>
    </div>

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
                @foreach($categories as $category)
                <tr>
                <td>{{ $category->id }}</td>
                <td><img src="{{ asset('uploads/img/category/'. $category->img )}}" class="img-thumbnail" alt="" width="90"></td>
                <td>{{ $category->name }}</td>
                <td>
                    <div style="color:white;" class="d-flex mt-2">
                        <form action="{{ route('categories.edit', $category->id) }}" method ="get">
                            <button type="submit" class="btn btn-dark mt-3"><i class="far fa-edit"></i> Edit</button>
                        </form>
                        <form class="ml-3" action="{{ route('categories.destroy', $category->id )}}" method ="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" onclick="return confirm('Bạn có muốn xóa category {{ $category->name }} không !')" class="btn btn-danger mt-3" href="{{route('categories.destroy', $category->id)}}" ><i class="far fa-trash-alt"></i> Delete</button>
                            <!-- <button type="submit" class="btn btn-danger mt-3"><i class="far fa-trash-alt"></i> Delete</button> -->
                        </form>

                        <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('categories.destroy', $category->id)}}">Delete</a> -->
                    </div>
                </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <h6><i>Restore Or Force Delete The Category Have Been SoftDelete<a style="color:red;" href="{{ route('restore') }}"> Click Me !</a></i></h6>

        <!-- {! $categories->render('pagination') !} -->
        @include('pagination', ['paginator' => $categories])
        <!-- pagination là file view của phần phân trang -->
    </div>

@endsection