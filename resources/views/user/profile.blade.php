@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="col-md-2">
    <br><br><br><br>
        <a href="{!! url('reminders') !!}" class="btn btn-success btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-home" style="font-size:40px"></span><br>
            Home
        </a>
        <a href="{!! url('users') !!}/{!!Auth::user()->id!!}" class="btn btn-warning btn-lg" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-user" style="font-size:40px"></span><br>
            Profile
        </a>
        <a href="{!! url('reminders/create') !!}" class="btn btn-danger btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-pushpin" style="font-size:40px"></span><br>
            Add Reminder
        </a>
        <a href="{!!url('/logout')!!}" class="btn btn-primary btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-log-out" style="font-size:40px"></span><br>
            Logout
        </a>
    </div>
    <div class="col-md-offset-2 col-md-5">
        <div class="row" style="height: 80px">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{!! Session::get('flash_notification.level') !!} fade in" style="margin-top: 10px" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! Session::get('flash_notification.message') !!}
                    </div>
                @endif
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
            @if ($users->first()->id == Auth::user()->id)
                {!! Form::open(array('route' => array('users.update', $users->first()->id), 'data-toggle' => 'validator','files' => 'true')) !!}
               {!!csrf_field()!!}
               {!!method_field('PATCH')!!}
               <div class="form-group">
                   <div class="center-block" style="width: 150px;height: 150px; 5px solid black">
                       <img src="{!! URL::asset($file)!!}" width="150px" height="150px">
                   </div>
               </div>
               <div class="form-group">
               <div class="center-block">
                    {!! Form::label('profile_photo', 'Change Profile Photo') !!}
                    {!!Form::file('profile_photo')!!}
                </div>
               </div>
                <div class="form-group">
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', $users->first()->username, array('class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required', 'data-error' => 'Username must not be empty')) !!}
                    <div class="help-block with-errors">
                        @if($errors->has('username'))
                            {!! $errors->first('username') !!}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('first_name', 'First Name') !!}
                            {!! Form::text('first_name',$users->first()->first_name, array('class' => 'form-control', 'placeholder' => 'First Name')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('last_name', 'Last Name') !!}
                            {!! Form::text('last_name',$users->first()->last_name, array('class' => 'form-control', 'placeholder' => 'Last Name')) !!}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info form-control">
                    <span class="glyphicon glyphicon-wrench"></span>
                    Update
                </button>
               {!! Form::close()!!}
            @else
                <div class="form-group">
                   <div class="center-block" style="width: 150px;height: 150px; 5px solid black">
                       <img src="{!! URL::asset($file)!!}" width="150px" height="150px">
                   </div>
                </div>
                <div class="form-group">
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', $users->first()->username, array('class' => 'form-control', 'readonly' => 'readonly')) !!}
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('first_name', 'First Name') !!}
                            {!! Form::text('first_name',$users->first()->first_name, array('class' => 'form-control', 'readonly' => 'readonly')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('last_name', 'Last Name') !!}
                            {!! Form::text('last_name',$users->first()->last_name, array('class' => 'form-control', 'readonly' => 'readonly')) !!}
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(750, 0).slideUp(750, function(){
            $(this).remove(); 
        });
    }, 1500);
</script> 
@stop