@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fab fa-adn"></i> Stories</h5>
@endsection

@section('content')
    <div>
        <div class="d-flex">
        <div class="py-3"></div>
        <div class="py-3"></div>
        <div class="ml-auto  pt-3 pb-3"><a class="btn btn-info" role="button" href="{{ route('stories.create') }}"> <i class="fas fa-plus-circle"></i> Add Story</a></div>
    </div>
    </div>
    
    <div class="container-fluid">
        <!-- seach -->
        <div class="container">

            {{-- CÁCH 1: --}}
            {{-- <div class="row">
                <form action="{{ route('search') }}" method="get" id="search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="input-group ">
                        <input type="text" class="form-control"  type="search" name="content" placeholder=" Search..." aria-describedby="addon-wrapping">
                        <div class="input-group-prepend">
                            <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit"><i style="color:Tomato;" class="fa fa-search fa-lg"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <div class="row input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Select By</label>
                </div>
                <select class="custom-select" id="inputGroupSelect02" name="category" onchange="location = this.value;">
                    <!-- Sử dụng onchange="location = this.value;" để chạy value -->
                    <option value="{{route('stories.index')}}" >ALL</option>
                    @foreach($categories as $category)
                    <option value="{{route('stories.show',$category->id)}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            
            {{-- CÁCH 2: --}}
            <br>
            <div class="row">
                <form action="{{ route('search') }}" method="get" id="search">
                    @csrf
                    
                    <label>SEARCH: </label>
                    <div class="input-group">
                    <select name="category" class="custom-select">
                        <option value="0" selected="selected">ALL</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                <input type="text" class="form-control"  type="search" name="content" placeholder=" Search..." value="{{ old('content', '') }}" aria-describedby="addon-wrapping">

                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit"><i style="color:Tomato;" class="fa fa-search"> Search</i></button>
                    </div>
                    </div>
                </form>
            </div>


        </div>
        <br><br><br><br><BR>
        
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category Name</th>
                    <th>Audio</th>
                    <th>Image</th>
                    <th>View</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stories as $story)
                <tr>
                <td>{{ $story->id }}</td>
                <td>{{ $story->title }}</td>
                <td>{{ $story->category->name }}</td>
                <td>
                    @if(is_file(public_path().'/uploads/audio/story/'.$story->audio))
                        <audio controls="controls"><source src="{{ asset('uploads/audio/story/' . $story->audio )}}" type="audio/mpeg"></audio> 
                        <!-- Hoặc: src="uploads/audio/story/{{ $story->audio }}" -->
                    @elseif($story->audio == NULL )
                        {{ 'No Audio' }}
                    @else
                        {{ $story->audio }}   
                    @endif
                </td>
                <td>
                    @if(is_file(public_path().'/uploads/img/story/' . $story->img))
                        <img src="{{ asset('uploads/img/story/' . $story->img) }}" class="img-thumbnail" alt="" height="" width="250px">
                    @else
                        {{ 'No Image' }}
                    @endif
                </td>
                <td>
                    <button type="button" data-toggle="modal" data-target="#{{$story->id}}" class="btn btn-outline-dark"><i class="fas fa-eye"></i> View</button>
                </td>
                <td>
                    <div style="color:white;" class="d-flex">
                        <form action="{{ route('stories.edit', $story->id) }}" method ="get">
                            <button type="submit" class="btn btn-dark"><i class="far fa-edit"></i> Edit</button>
                        </form>
                        <form class="ml-3" action="{{ route('stories.destroy', $story->id )}}" method ="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" onclick="return confirm('Bạn có muốn xóa story {{ $story->title }} không !')" class="btn btn-danger" ><i class="far fa-trash-alt"></i> Delete</button>
                            <!-- <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button> -->
                        </form>
                    </div>
                </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <h6><i>Restore Or Force Delete The Story Have Been SoftDelete<a style="color:red;" href="{{ route('restore-story') }}"> Click Me !</a></i></h6>
        <!-- <div class="row">
            <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Prev</a></li><li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Next</a></li>       </ul>
        </div> -->
        
        @include('pagination', ['paginator' => $stories]);
    </div>

    <div class="container col-md-6">
        @foreach($stories as $story)
        <!-- The Modal -->
        <div class="modal" id="{{$story->id}}">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">{{$story->title}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                @if(file_exists(public_path().'/uploads/img/story/' . $story->img))
                    <br>
                    <img src="{{ asset('uploads/img/story/' . $story->img) }}" class="img-thumbnail mx-auto d-block" alt="Image" height="auto" width="700">
                    <i style="text-align: center; margin-top:3px;" >Hình: {{$story->img}}</i>
                @endif
                <!-- Modal body -->
                <div class="modal-body">
                {!! $story->story !!}
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
            </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection