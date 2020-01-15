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

    <h1>all category</h1>

    <table class="table">
        <thead class="table">
        <tr>
            <th>id</th>
            <th>category name</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>control</th>
        </tr>
        </thead>
        @if($categories)
            @foreach($categories as $category)
                <tbody>
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td>{{$category->updated_at->diffForHumans()}}</td>
                    <td>

                        <form method="POST" action="{{route('category.destroy',$category->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="DELETE Category" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
                </tbody>
            @endforeach
        @endif
    </table>


@endsection
