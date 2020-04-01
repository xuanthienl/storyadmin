<!-- Header hold css-->
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">

    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <title>Story Admin</title>
    <link rel="shortcut icon" href="{{ asset('story.png') }}" type="image/x-icon">

  </head>
  <body>
    <div class="wrapper">

<!-- Sidemenu Holder -->
<nav id="sidebar" class="bg-info">
    <div class="sidebar-header bg-dark">
        <h5>STORY</h5>
    </div>

    <ul class="list-unstyled components">
      <li>
        <a href="{{ route('dashboard') }}"><i class="fas fa-th"></i>DASHBOARD</a>
      </li>
      <div class="sidebar_line"></div>
      <li>
        <a href="{{ route('categories.index') }}"><i class="fas fa-th-large"></i>CATEGORY</a>
      </li>
      <div class="sidebar_line"></div>
      <li>
        <a href="{{ route('stories.index') }}"><i class="fas fa-file-alt"></i>STORY</a>
      </li>
      <div class="sidebar_line"></div>
      <li>
        <a href="{{ route('user.index') }}"><i class="fas fa-file-alt"></i>USER</a>
      </li>
      <div class="sidebar_line"></div>
      <li>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
          <i class="fas fa-user"></i>ADMIN SETTING</a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li><a href="#"><i class="fab fa-quinscape"></i>API</a></li>
            <div class="sidebar_line"></div>
            <li><a href="{{ route('edit_profile') }}"><i class="fas fa-pencil-alt"></i>EDIT PROFILE</a></li>
            <div class="sidebar_line"></div>
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>LOGOUT</a></li>
        </ul>
    </li>
</ul></nav>

<div id="content">
  <nav class="navbar">
    @yield('title')
    <div class="dropdown">
      <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i  class="fas fa-user-circle fa-lg"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenu2">
        <button class="dropdown-item" type="button">{{ Auth::user()->username }}</button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"><a href="{{ route('logout') }}">Logout</a></button>
      </div>
    </div>
    {{-- <b>XIN CHÀO <a style="color:MediumSeaGreen;">{{ Auth::user()->username }} ! </a></b>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </li>
    </ul> --}}
  </nav>
  @yield('content')
</div>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

</body></html>