@extends('layouts.admin')

@section('content')
    
    <h1>Edit User</h1>

    @include('includes.form_error')

    <div class="row">
        <div class="col-sm-3">

            <img src="{{$user->photo ? $user->photo->file : 'https://fakeimg.pl/350x200/?text=Without+Photo'}}" alt="" class="img-responsive img-rounded">

        </div>
        <div class="col-sm-9">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', $user->email, ['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('role_id', 'Role:') !!}
                {!! Form::select('role_id', $roles, $user->role_id, ['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('is_active', 'Is Active') !!}
                {!! Form::select('is_active', array(1=>'Yes', 0=>'No') , $user->is_active, ['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('photo_id', 'Photo') !!}
                {!! Form::file('photo_id', ['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::submit('Update User', ['class'=>'btn btn-primary']) !!}
            </div>
        
            {!! Form::close() !!}

            <hr>

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

            {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}

            {!! Form::close() !!}

            <hr>

        </div>
    </div>

@endsection
