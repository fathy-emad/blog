
@extends('layouts.admin')



@section('content')
    <h1>Create post</h1>

    <div class="form-group">
        {!! Form::open(['method'=>'POST','route'=>'posts.store','files'=>true]) !!}

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

        <label for="category_id">select category :</label>
        <select class="form-control" name="category_id">
            @foreach($cats as $cat)
            <option  value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>


        {{--submit the form--}}
        <div class="form-group">
            {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
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
