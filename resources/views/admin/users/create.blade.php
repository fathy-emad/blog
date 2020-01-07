
@extends('layouts.admin')



@section('content')
    <h1>Create user</h1>

    <div class="form-group">
        {!! Form::open(['method'=>'POST','route'=>'users.store','files'=>true]) !!}

        {{csrf_field()}}

        {{--username field--}}
        <div class="form-group">
            {!! Form::label('name','User Name : ') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>


        {{--email field--}}
        <div class="form-group">
            {!! Form::label('email','User Email : ') !!}
            <input class="form-control" type="email" name="email" placeholder="example@example.com">
        </div>


        {{--password field--}}
        <div class="form-group">
            {!! Form::label('password','User Password : ') !!}

            <input class="form-control" type="password" name="password" placeholder="type your password">
        </div>
        {{--role feild--}}
        <div class="form-group">
             {!! Form::label('role_id','User Role : ')!!}

             {!! Form::select('role_id',[''=>'--choose user role--','1'=>'admin','2'=>'user'],null,['class'=>'form-control']) !!}

        </div>


        {{--status field--}}
        <div class="form-group">
            {!! Form::label('is_active','User active : ') !!}
            {!! Form::select('is_active',[''=>'--choose activation--','1'=>'active','0'=>'not active'],null,['class'=>'form-control']) !!}
        </div>

        {{--upload photo user--}}
        {!! Form::label('path','User photo : ') !!}
        {!! Form::file('path') !!}



        {{--submit the form--}}
        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
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
