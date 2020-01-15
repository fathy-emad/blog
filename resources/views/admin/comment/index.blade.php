@extends('layouts.admin')




@section('content')

    <h1>users</h1>

    <table class="table">
        <thead class="table">
        <tr>
            <th>id</th>
            <th>user photo</th>
            <th>user</th>
            <th>post id</th>
            <th>comment</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>control</th>
        </tr>
        </thead>
        @foreach($comments as $comment)
            <tbody>
            <tr>
                <td>{{$comment->id}}</td>
                <td><img height="50px" class="img-rounded" src="{{asset($comment->photo_author_comment)}}"></td>
                <td>{{$comment->author}}</td>
                <td>{{$comment->post_id}}</td>
                <td>{{$comment->comment}}</td>
                <td>{{$comment->created_at->diffForHumans()}}</td>
                <td>{{$comment->updated_at->diffForHumans()}}</td>
                <td>

                    <form method="POST" action="{{route('users.destroy',$comment->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="DELETE USER" class="btn btn-danger">
                    </form>

                    | <a href="{{route('users.edit',$comment->id)}}" class="btn btn-primary">edit</a>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>



@endsection
