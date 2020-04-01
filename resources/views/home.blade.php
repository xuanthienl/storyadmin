<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>Page Stories</title>
</head>
<body>
    <div class="container mt-2">
    <h1 style="color:dark; text-align: center; background-color:Orange; border: 2px solid red; padding: 5px;" ><b>PAGE STORIES !</b></h1>

    <!-- THANH MENU -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-2">
    <a class="navbar-brand" href="{{ route('home') }}">iStories.</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a style="color:Tomato; border-left: 2px solid black;" class="nav-link" href="{{ route('home') }}" >Home</a>
        </li>
        @foreach($categories as $category)
        <li class="nav-item">
        <a style="color:Tomato; border-left: 2px solid black;" class="nav-link" href="{{ route('PageCategory', $category->id) }}">{{ $category->name }}</a>
        </li>
        @endforeach
    </ul>
    <p class="mt-3" style="color:tomato; margin-left:170px;">{{ date("Y/m/d")}}</p>
    <!-- <form action="" method="get">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="search-box">
            <a class="search-btn" href="" type="submit" name="timkiem" >
                <input class="search-txt" type="search" name="timkiem" placeholder="Search...">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
        </div>
    </form> -->
    <!-- <a href="{{ route('logout') }}" class="btn" style="color:white;" role="button">Logout !</a> -->
    </nav>
    @if (Auth::check())
    <div class="row">
        <div class='col-6'>
        <p><i>Xin chào bạn <a style="color:MediumSeaGreen;">{{ Auth::user()->username }} ! </a></i></p>
        </div>
        <div class="col-6" style="text-align: right;">
        <a style="color:rgb(60, 179, 113);" href="{{ route('logout') }}"><b>Logout </b><i class="fas fa-sign-out-alt"></i></a>
        <!-- <a href="{{ route('logout') }}" class="btn btn-outline-dark" role="button">Logout !</a> -->
        </div>
    </div>
    @else
    <div class="row">
        <div class='col-6'>
        <p><i>Xin chào bạn đến với iStories !. Hãy đăng nhập... </a></i></p>
        </div>
        <div class="col-6" style="text-align: right;">
        <a style="color:rgb(60, 179, 113);" href="{{ route('login') }}"><b>SignIn/SignUp </b><i class="fas fa-sign-in-alt"></i></a>
        <!-- <a href="{{ route('login') }}" class="btn btn-outline-dark" role="button">Login !</a> -->
        </div>
    </div>
    @endif

    <!-- <a href="{{ route('stories.create') }}" class="btn btn-info mt-3" role="button">Create New Story</a> -->
    
    @foreach($stories as $story)
    <div class="jumbotron mt-3">
        <h1><a style="color:black;" href='{{ route("PageStory", $story->id) }}'>{{ $story->title }}</a></h1><hr>      
        <p>{!! $story->story !!}</p>
        <img src="{{ asset('uploads/img/story/' . $story->img) }}" class="img-thumbnail mx-auto d-block" alt="Image" height="200" width="auto">

        <!-- @if (Auth::check())
        <hr>
        <div class="d-flex mt-2">
            <form action="{{ route('stories.edit', $story->id )}}" method ="get">
                <button type="submit" class="btn btn-info mt-3">EDIT</button>
            </form>
            <form class="ml-3" action="{{ route('stories.destroy', $story->id )}}" method ="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger mt-3">DELETE</button>
            </form>
        </div>
        @endif -->
    </div>
    @endforeach
    </div>
</body>
</html>