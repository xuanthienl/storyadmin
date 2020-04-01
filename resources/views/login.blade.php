<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
<div class="container mt-5">
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Email:</label>
        <input type='email' name='email' placeholder='Enter your Email !' value="{{ old('email','') }}">
        @if ($errors->has('email'))
            <p class="alert alert-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="">Password:</label>
        <input type='password' name='password' placeholder='Enter your password !'>
        @if ($errors->has('password'))
            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
        @endif
    </div>
    <button type='submit'>LOGIN</button>
    </form>
</div>
</body>
</html> -->



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
    <div class="logo"><i class="fab fa-searchengin"></i> STORY ADMIN</div>
    <div class="login-item">
      <form action="{{ route('postlogin') }}" method="post" class="form form-login">
        @csrf
        <div class="form-field">
          <label class="user" for="login-username"><span class="hidden">Username</span></label>
          <input id="login-username" name="username" type="text" class="form-input" placeholder="Username">
        </div>
            <!-- @if ($errors->has('username'))
            <p class="alert alert-danger">{{ $errors->first('username') }}</p>
            @endif -->
        <div class="form-field">
          <label class="lock" for="login-password"><span class="hidden">Password</span></label>
          <input id="login-password" name="password" type="password" class="form-input" placeholder="Password" value="">
        </div>
            <!-- @if ($errors->has('password'))
            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
            @endif -->
        <div class="form-field">
          <input type="submit" value="Log in" name="submit">
        </div>
        <p><i>Bạn chưa tạo tài khoản... <a href="{{ route('register' )}}" style="color:MediumSeaGreen;">REGISTER ! </a></i></p>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('thongbao'))
            <div class="alert alert-danger">
                {{ session('thongbao') }}
            </div>
        @endif
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