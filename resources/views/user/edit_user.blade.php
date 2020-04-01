@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fab fa-adn"></i> User... </h5>
@endsection

@section('content')
        <br>
        <form action="{{ route('user.update', $user->id) }}" method="post" class="form form-login">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value={{csrf_token()}}>

            <div class="form-group">
                <label for="">Username:</label>
                <input type="text" class="form-control" placeholder="Enter Username" name="username" value="{{ $user->username }}">
                @if ($errors->has('username'))
                    <br>
                    <p class="alert alert-danger">{{ $errors->first('username') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{ $user->email }}">
                @if ($errors->has('email'))
                    <br>
                    <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info font-weight-bold">Update</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary" role="button">Close</a>
            </div>
        </form>
@endsection