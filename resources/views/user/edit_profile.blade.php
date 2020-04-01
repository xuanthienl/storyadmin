@extends('master')

@section('title')
  <h5 class="navbar-brand"><i class="fas fa-user"></i> Profile Setting</h5>
@endsection

@section('content')

  <div class="row p-4">
    <div class="col-md-5">
    <form action="{{ route('update_profile', $user->id) }}" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value={{csrf_token()}}>

        <div class="form-group">
          <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" value="{{ $user->username }}">
        @if ($errors->has('username'))
            <br>
            <p class="alert alert-danger">{{ $errors->first('username') }}</p>
        @endif
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ $user->email }}">
        @if ($errors->has('email'))
            <br>
            <p class="alert alert-danger">{{ $errors->first('email') }}</p>
        @endif
        </div>
        <div class="form-group">
          <label for="password">Passward:</label>
          <input type="password" class="form-control" id="password" placeholder="Enter Passward" name="password">
          @if ($errors->has('password'))
              <br>
              <p class="alert alert-danger">{{ $errors->first('password') }}</p>
          @endif
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password:</label>
          <input type="password" class="form-control" id="cpassword" placeholder="Enter Confirm Passward" name="password_confirmation">
          @if ($errors->has('password'))
              <br>
              <p class="alert alert-danger">{{ $errors->first('password') }}</p>
          @endif
        </div>

        <button type="submit" name="submit" class="btn btn-info"> Update </button>
      </form>
    </div>
  </div>

@endsection