@extends('layouts.admin')


@section('content')

    @if(session()->has('deletepost'))
        <p class="bg-danger">{{Session('deletepost')}}</p>
    @endif

    @if(session()->has('updatepost'))
        <p class="bg-danger">{{Session('updatepost')}}</p>
    @endif

    @if(session()->has('createdpost'))
        <p class="bg-danger">{{Session('createdpost')}}</p>
    @endif

    @if(session()->has('deleted_user'))
        <p class="bg-danger">{{Session('deleted_user')}}</p>
    @endif

    <h1>all posts</h1>

    <table class="table">
        <thead class="table">
        <tr>
            <th>id</th>
            <th>user id</th>
            <th>photo id</th>
            <th>title</th>
            <th>body</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>control</th>
        </tr>
        </thead>
        @if($posts)
            @foreach($posts as $post)
                <tbody>
                <tr>
    {{--                $user->photo_id>0?asset($user->photo['path']):'http://place-hold.it/50x50--}}
                    <td>{{$post->id}}</td>
                    <td>{{$post->user_id}}</td>
                    <td><img height="50px" class="img-rounded" src="{{$post->photo_id >0 ?asset($post->photo->path):'http://placehold.it/0x50'}}"></td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>

                        <form method="POST" action="{{route('posts.destroy',$post->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="DELETE POST" class="btn btn-danger">
                        </form>

                        | <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">edit</a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        @endif
    </table>


@endsection
