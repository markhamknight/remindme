@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="col-md-2">
    <br><br><br><br>
        <a href="{!! url('reminders') !!}" class="btn btn-success btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-home" style="font-size:40px"></span><br>
            Home
        </a>
        <a href="{!! url('users') !!}/{!!Auth::user()->id!!}" class="btn btn-warning btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-user" style="font-size:40px"></span><br>
            Profile
        </a>
        <a href="{!! url('reminders/create') !!}" class="btn btn-danger btn-lg" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-pushpin" style="font-size:40px"></span><br>
            Add Reminder
        </a>
        <a href="{!!url('/logout')!!}" class="btn btn-primary btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-log-out" style="font-size:40px"></span><br>
            Logout
        </a>
    </div>
    <div class="col-md-offset-2 col-md-5" style="margin-top: 80px">
        <div class="panel panel-success">
            <div class="panel-heading">New Reminder</div>
            <div class="panel-body">
               {!! Form::open(['route' => 'reminders.store', 'data-toggle' => 'validator']) !!}
               {!!csrf_field()!!}
                <div class="form-group">
                        {!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required', 'data-error' => 'Title must not be empty')) !!}
                        <div class="help-block with-errors">
                            @if($errors->has('title'))
                                {!! $errors->first('title') !!}
                            @endif
                        </div>
                </div>
                
                <div class="form-group">
                    {!! Form::textarea('body',null, array('class' => 'form-control', 'placeholder' => 'Body', 'rows' => '3', 'style' => 'resize:vertical', 'required' => 'required', 'data-error' => 'Body must not be empty')) !!}
                    <div class="help-block with-errors">
                            @if($errors->has('body'))
                                {!! $errors->first('body') !!}
                            @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('privacy', 'Privacy Setting:') !!}
                            {!! Form::select('privacy', array('Public' => 'Public', 'Private' => 'Private'), 'Public', ['title' => 'Privacy Setting', 'class' => 'selectpicker form-control']) !!}
                        </div>
                         <div class="col-md-4">
                            {!! Form::label('due_date', 'Remind me on:') !!}
                            {!! Form::text('due_date',$now, array('class' => 'form-control', 'placeholder' => 'Due Date','data-provide' => 'datepicker', 'data-date-format' => 'MM dd, yyyy', 'readonly' => 'readonly')) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('tag', 'Tag:') !!}
                            {!! Form::select('tag', array('School' => 'School', 'Personal' => 'Personal', 'Others' => 'Others'), 'School', ['class' => 'selectpicker form-control']) !!}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success form-control">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add
                </button>
               {!! Form::close()!!} 
            </div>
        </div>
    </div>
</div>
@stop