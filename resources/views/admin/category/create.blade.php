
@extends('layouts.admin')



@section('content')
    <h1>Create post</h1>

    <div class="form-group">
        {!! Form::open(['method'=>'POST','route'=>'category.store']) !!}

        {{csrf_field()}}

        {{--title field--}}
        <div class="form-group">
            {!! Form::label('name','category name : ') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>

        {{--submit the form--}}
        <div class="form-group">
            {!! Form::submit('Create category',['class'=>'btn btn-primary']) !!}
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
