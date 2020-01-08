@extends('layouts.admin')



@section('content')
    <h1>edit users</h1>

    <div class="col-sm-3">

        <img height="200" class="img-circle" src="{{$user->photo_id>0?asset($user->photo['path']):'http://place-hold.it/50x50'}}" alt="userphoto">
    </div>

    <div class="col-sm-9">
        {!! Form::model($user,['method'=>'PATCH','route'=>['users.update',$user->id],'files'=>true]) !!}

        {{csrf_field()}}

        {{--username field--}}
        <div class="form-group">
            {!! Form::label('name','User Name : ') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>


        {{--email field--}}
        <div class="form-group">
            {!! Form::label('email','User Email : ') !!}
            {!! Form::email('email',null,['class'=>'form-control']) !!}
        </div>


        password field
        <div class="form-group">
            {!! Form::label('password','User Password : ') !!}
            {!! Form::password('password',null,['class'=>'form-control']) !!}
        </div>
        role feild
        <div class="form-group">
            {!! Form::label('role_id','User Role : ')!!}
            {!! Form::select('role_id',[''=>'--choose user role--','1'=>'admin','2'=>'user'],null,['class'=>'form-control']) !!}

        </div>


        {{--status field--}}
        <div class="form-group">
            {!! Form::label('is_active','User active : ') !!}
            {!! Form::select('is_active',[''=>'--choose activation--','1' =>'active','0' =>'not active'],null,['class'=>'form-control']) !!}
        </div>


        {{--upload photo user--}}
        {!! Form::label('path','User photo : ') !!}
        {!! Form::file('path') !!}


        {{--submit the form--}}
        <div class="form-group">
            {!! Form::submit('update User',['class'=>'btn btn-primary']) !!}
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
