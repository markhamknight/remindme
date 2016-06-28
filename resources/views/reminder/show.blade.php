@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="col-md-2">
    <br><br><br><br>
        <a href="{!! url('reminders') !!}" class="btn btn-success btn-lg" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-home" style="font-size:40px"></span><br>
            Home
        </a>
        <a href="{!! url('users') !!}/{!!Auth::user()->id!!}" class="btn btn-warning btn-xs" style="width: 100%; margin-bottom: 30px">
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
    <div class="col-md-10">
        <div class="col-md-12" style="height: 80px">
            @if (Session::has('flash_notification.message'))
                <div class="alert alert-{!! Session::get('flash_notification.level') !!} fade in" style="margin-top: 10px" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! Session::get('flash_notification.message') !!}
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center;">
                        <h2 class="panel-title">{!! $reminders->first()->title !!}</h2>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('body', 'Content:') !!}
                        {!! Form::textarea('privacy',$reminders->first()->body, array('class' => 'form-control','readonly' => 'readonly','style' => 'resize:none','rows' => '3')) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::label('privacy', 'Privacy Setting:') !!}
                                {!! Form::text('privacy',$reminders->first()->privacy, array('class' => 'form-control','readonly' => 'readonly')) !!}
                            </div>
                            <div class="col-md-4">
                               {!! Form::label('due_date', 'Due on:') !!}
                               {!! Form::text('due_date',$reminders->first()->due_date, array('class' => 'form-control','readonly' => 'readonly')) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('tag', 'Tag:') !!}
                                {!! Form::text('tag', $reminders->first()->tag->name, ['class' => 'selectpicker form-control', 'readonly' => 'readonly']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                <div class="form-group clearfix">
                @if (Auth::user()->id == ($reminders->first()->user->id))
                    {!! Form::open(array('route' => array('reminders.destroy', $reminders->first()->id), 'data-toggle' => 'validator')) !!}
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}
                        <a href="{!! url('reminders')!!}/{!!$reminders->first()->id!!}/edit" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Edit</a>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete</button> 
                @endif
                    <a class="btn btn-info" data-toggle="collapse" data-target="#notes">Hide/Show Notes</a>
                    <a class="btn btn-success" data-toggle="collapse" data-target="#addnote"><span class="glyphicon glyphicon-pencil"></span>Add Note</a>
                    {!!Form::close()!!}
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success" class="collapse" id="notecontainer">
                <div class="panel-heading">
                       <h4 class="panel-title">Notes:</h4> 
                </div>
                <div class="panel-body">
                    <div id="notes" class="collapse in">
                        @if (!count($notes))
                            <div class="center-block" id="noteinfo"><h2>No Notes</h2></div>
                        @endif
                        <div class="panel-group" id="accordion">
                            @foreach ($notes as $note)
                                <div class="panel panel-default " id="note_{!!$note->id!!}">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#{!!$note->id!!}">{!! $note->title !!}</a>
                                            <span class="pull-right"><small>by </small><span><a href="{!! url('users')!!}/{{$note->user->id}}">{!!$note->user->username!!}</a></span></span>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="{!!$note->id!!}">
                                        <div class="panel-body">
                                           {!!$note->body!!}
                                        </div>
                                        @if (Auth::user()->id == ($note->user->id))
                                            <div class="panel-footer">
                                               <a href="{!!url('notes')!!}/{!!$note->id!!}/edit" class="btn btn-warning btn-xs">Edit</a>
                                               <button type="button" class="btn btn-danger btn-xs delete-button" value="{!!$note->id!!}">Delete</button>
                                            </div>
                                        @endif
                                    </div>
                               </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div id="addnote" class="collapse">
                        {!! Form::label('addnote', 'New Note:') !!}
                        {!! Form::open(array('data-toggle' => 'validator', 'route' => 'notes.store', 'name' => 'addnote')) !!}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            {!! Form::text('title',null, array('class' => 'form-control','data-error' => 'Title must not be empty', 'placeholder' => 'Title', 'required' => 'required', 'id' => 'note_title')) !!}
                            <div class="help-block with-errors">
                                @if($errors->has('title'))
                                    {!! $errors->first('title') !!}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::text('body',null, array('class' => 'form-control','style' => 'resize:vertical','rows' => '3', 'data-error' => 'Body must not be empty', 'required' => 'required', 'placeholder' => 'Body', 'id' => 'note_body')) !!}
                            <div class="help-block with-errors">
                                @if($errors->has('body'))
                                    {!! $errors->first('body') !!}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::hidden('reminder_id',$reminders->first()->id,array('id' => 'reminder_id')) !!}
                            <button type="button" class="btn btn-primary" id="addbutton"><span class="glyphicon glyphicon-check"></span>Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop