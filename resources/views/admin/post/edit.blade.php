@extends('layouts.admin')



@section('content')
    <h1>edit post</h1>

    <div class="col-sm-3">

        <img height="200" class="img-circle" src="{{$post->photo_id>0?asset($post->photo['path']):'http://place-hold.it/50x50'}}" alt="userphoto">
    </div>

    <div class="col-sm-9">
        {!! Form::model($post,['method'=>'PATCH','route'=>['posts.update',$post->id],'files'=>true]) !!}

        {{csrf_field()}}

        {{--title field--}}
        <div class="form-group">
            {!! Form::label('title','Post Title : ') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>


        {{--body field--}}
        <div class="form-group">
            {!! Form::label('body','Post Body : ') !!}
            {!! Form::textarea('body',null,['class'=>'form-control']) !!}
        </div>


        {{--upload photo user--}}
        {!! Form::label('path','Post photo : ') !!}
        {!! Form::file('path') !!}


        {{--submit the form--}}
        <div class="form-group">
            {!! Form::submit('update post',['class'=>'btn btn-primary']) !!}
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::close() !!}
    </div>


@endsection
