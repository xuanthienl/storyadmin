<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <title>Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="container">
    <div class="logo"><i class="fab fa-searchengin"></i> STORY ADMIN REGISTER</div>
    <div class="login-item">
      <form action="{{ route('postregister') }}" method="post" class="form form-login">
        @csrf
        <div class="form-field">
          <label class="user" for="login-username"><span class="hidden">Username</span></label>
          <input id="login-username" name="username" type="text" class="form-input" placeholder="Username" value="{{ old('username','') }}">
        </div>
            @if ($errors->has('username'))
            <p class="alert alert-danger">{{ $errors->first('username') }}</p>
            @endif
        <div class="form-field">
          <label class="user" for="login-email"><span class="hidden">Email</span></label>
          <input id="login-email" name="email" type="text" class="form-input" placeholder="Email" value="{{ old('email','') }}">
        </div>
            @if ($errors->has('email'))
            <p class="alert alert-danger">{{ $errors->first('email') }}</p>
            @endif
        <div class="form-field">
          <label class="lock" for="login-password"><span class="hidden">Password</span></label>
          <input id="login-password" name="password" type="password" class="form-input" placeholder="Password" value="">
        </div>
            @if ($errors->has('password'))
            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
            @endif
        <div class="form-field">
          <input type="submit" value="register" name="submit">
        </div>
        <p><i>Bạn đã có tài khoản... <a href="{{ route('login' )}}" style="color:MediumSeaGreen;">LOGIN ! </a></i></p>
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}
      </form>
          </div>
</div>
<footer id="footer">© Copyright 2020 by IF-Vietnam. All Rights Reserved.</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>