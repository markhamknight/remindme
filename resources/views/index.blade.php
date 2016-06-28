@extends('layouts.layout')

@section('content')
<div class="container">
    <br><br><br>
    <div class="panel-group col-md-5">
        <div class="panel panel-info">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
               {!! Form::open(['url' => 'login', 'method' => 'post', 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        {!! Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required', 'data-error' => 'Invalid Username')) !!}
                    </div>
                    <div class="help-block with-errors">
                        @if($errors->has('username'))
                            {!! $errors->first('username') !!}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-plus"></span></span>
                        {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'required' => 'requried', 'data-error' => 'Invalid Password')) !!}
                        {!!csrf_field()!!}
                    </div>
                    <div class="help-block with-errors">
                        @if($errors->has('password'))
                            {!! $errors->first('password') !!}
                        @endif
                    </div>
                </div>
                <p class="help-block" style="font-size: smaller; color: red;">
                    @if($errors->has('login'))  
                        {!! $errors->first('login') !!}
                    @endif
                </p>
                <button type="submit" class="btn btn-info form-control">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Login
                </button>
               {!! Form::close()!!} 
            </div>
        </div>
        <br/>
        <br/>
        <div class="panel panel-success">
            <div class="panel-heading">Signup</div>
            <div class="panel-body">
                 {!! Form::open(['url' => 'register', 'method' => 'get','data-toggle' => 'validator']) !!}
                 {!! csrf_field() !!}
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        {!! Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username','required' => 'required', 'data-error' => 'Username must not be blank', 'id' => 'userName')) !!}
                    </div>
                    <div class="help-block with-errors" id="checker">
                        @if($errors->has('username'))
                            {!! $errors->first('username') !!}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-plus"></span></span>
                        {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password','required' => 'required', 'data-error' => 'Password must not be blank')) !!}
                    </div>
                    <div class="help-block with-errors">
                        @if($errors->has('password'))
                            {!! $errors->first('password') !!}
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-success form-control">
                    <span class="glyphicon glyphicon-user"></span>
                    Sign up!
                </button>
               {!! Form::close()!!} 
            </div>
        </div>
</div>
</div>
@stop
