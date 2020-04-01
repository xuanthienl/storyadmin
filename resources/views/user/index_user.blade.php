@extends('master')

@section('title')
    <h5 class="navbar-brand"><i class="fab fa-adn"></i> User... </h5>
@endsection

@section('content')
    <br>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Birth Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    @if($user->deleted_at == NULL)
                        {{ $user->username }}
                    @else
                        {!! $user->username . " " . "<b>" . "(Blocked !)" . "</b>" !!}
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ md5($user->password) }}</td>
                @if($user->created_at == NULL)
                    <td>{{'undefined'}}</td>
                @else
                    <td>{{ $user->created_at }}</td>
                @endif
                <td>
                    @if($user->deleted_at == NULL)
                    {{-- Hoặc dùng $user->trashed() để ktra user đó có phải đã bị xóa mềm ko --}}
                    <div style="color:white;" class="d-flex mt-2">
                        <form action="{{ route('user.edit', $user->id) }}" method ="GET">
                            <button type="submit" class="btn btn-info mr-2"><i class="far fa-edit"></i>Edit</button>
                        </form>
                        <form class="" action="{{ route('user.destroy', $user->id )}}" method ="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" onclick="return confirm('Bạn có muốn xóa User {{ $user->username }} không !')" class="btn btn-danger" ><i class="far fa-trash-alt"></i> Delete</button>
                        </form>
                    </div>
                    @else
                    <div style="color:white;" class="d-flex mt-2">
                        <form action="{{ route('user.restore', $user->id) }}" method ="GET">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có muốn khôi phục User {{ $user->username }} không ?')"><i class="far fa-edit"></i>Restore</button>
                        </form>
                        <form action="{{ route('user.forcedelete', $user->id) }}" method ="GET">
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn User {{ $user->username }} không ?')" class="btn btn-dark ml-3"><i class="far fa-edit"></i>Force Delete</button> 
                            <!-- XÓA VĨNH VIỄN -->
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    
@endsection        