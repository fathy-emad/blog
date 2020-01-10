@extends('layouts.admin')




@section('content')

    @if(session()->has('deleted_user'))
        <p class="bg-danger">{{Session('deleted_user')}}</p>
        @endif

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
                <td><img height="50px" class="img-rounded" src="{{$user->photo_id>0?asset($user->photo['path']):'http://place-hold.it/50x50'}}"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role['name']}}</td>
                <td>{{$user->is_active == 1 ? 'active' : 'not active'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td>

                        <form method="POST" action="{{route('users.destroy',$user->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="DELETE USER" class="btn btn-danger">
                        </form>

{{--                    {!! Form::open(['method'=>'DELETE','route'=>['users.index',$user->id]])!!}--}}
{{--                        {{csrf_field()}}--}}
{{--                        {!! Form::submit(['DELETE USER',['class'=>'btn btn-danger']]) !!}--}}
{{--                    {!! Form::close() !!}--}}
                    | <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">edit</a>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>



@endsection
