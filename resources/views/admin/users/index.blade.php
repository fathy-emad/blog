@extends('layouts.admin')




@section('content')

    <h1>users</h1>

    <table class="table">
        <thead class="table">
            <tr>
                <th>id</th>
                <th>user photo</th>
                <th>name</th>
                <th>email</th>
                <th>role</th>
                <th>is_active</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>control</th>
            </tr>
        </thead>
        @foreach($users as $user)
        <tbody>
            <tr>
                <td>{{$user->id}}</td>
                <td><img height="50px" src="images/{{$user->photo['path']}}" alt="{{$user->name}}"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->is_active == 1 ? 'active' : 'not active'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td><a class="btn btn-danger">delete</a> | <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">edit</a>@if($user->is_active !== 1) | <a class="btn btn-info">Active</a>@endif</td>
            </tr>
        </tbody>
        @endforeach
    </table>

@endsection
