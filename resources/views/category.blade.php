@extends('HomeMaster')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <style>
        p {
        width: auto;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        }
    </style>
    <div class="container-fluid">
        @foreach($stories as $story)
        <div class="row">
            <div class="col-8">
                <h3>{{ $story->title }}</h3>
                <i>{{$story->category->name}} - Ngày đăng {{ $story->created_at}}</i> 
                <!-- Dùng carbon để chỉnh sửa time -->
                <hr>
                <p id="story">{!! $story->story !!}</p>
                <!-- <button type="button" data-toggle="modal" data-target="#{{$story->id}}" class="btn btn-outline-info" >XEM CHI TIẾT...</button> -->
                <a href="{{ route('PageStory', $story->id)}}" class="btn btn-outline-info" >XEM CHI TIẾT...</a>
            </div>
            <div class="col-4">
                <img src="{{ asset('uploads/img/story/' . $story->img) }}" class="img-thumbnail mx-auto d-block" alt="Image" height="200" width="auto">
            </div>
        </div>
        <hr>
        @endforeach
    </div>

    <!-- <div class="container">
        @foreach($stories as $story)
        <div class="modal" id="{{$story->id}}">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
            <h4 class="modal-title">{{ $story->title }}</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
                @if(file_exists(public_path().'/uploads/img/story/' . $story->img))
                    <img src="{{ asset('uploads/img/story/' . $story->img) }}" class="img-thumbnail mx-auto d-block" alt="Image" height="auto" width="700">
                @endif  
                <p>{{ $story->story }}</p>
            </div>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        </div>
    </div>
    @endforeach
    </div> -->

@endsection