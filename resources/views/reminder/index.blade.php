@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="col-md-2">
    @if (count($public))
        <br>
    <button data-toggle="collapse" data-target="#publicreminders" class="btn btn-info btn-sm" style="width:100%; margin-bottom: 30px">View Public Reminders</button>
    @else
        <br><br><br><br>
    @endif
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
    <div class="col-md-offset-1 col-md-8">
        <div class="row" style="height: 80px">
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{!! Session::get('flash_notification.level') !!} fade in" style="margin-top: 10px" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! Session::get('flash_notification.message') !!}
                    </div>
                @endif
        </div>
        <div class="row">
            <div class="panel-group">
                @if(count($public))
                    <div class="panel panel-collapse collapse" style="background-color: rgba(225,190,231,0.5)" id="publicreminders">
                        <div class="panel-heading" style="background-color: rgba(156,39,176,0.5)">Public</div>
                        <div class="panel-body">
                             <div class="list-group">
                                @foreach ($public as $p)
                                    <a href="{!! url('reminders')!!}/{!!$p->id!!}" class="list-group-item">{!! $p->title !!}<label class="{!!$p->tag->style!!} pull-right">{!!$p->tag->name!!}</label></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @if (count($overdue))
                    <div class="panel" style="background-color: rgba(255,205,210,0.5)">
                        <div class="panel-heading" style="background-color: rgba(229,57,53,0.5)" href="#overdue_body" data-toggle="collapse">
                            <h4 class="panel-title">
                                <a href="#overdue_body" data-toggle="collapse">Overdue</a>
                                <span class="badge pull-right">{!!count($overdue)!!} Reminder/s</span>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse in" id="overdue_body" >
                            <div class="panel-body" >
                                 <div class="list-group">
                                     @foreach ($overdue as $o)
                                        <a href="{!! url('reminders')!!}/{!!$o->id!!}" class="list-group-item">{!! $o->title !!}<label class="{!!$o->tag->style!!} pull-right">{!!$o->tag->name!!}</label></a>
                                     @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="panel" style="background-color: rgba(227,242,253,0.5)">
                    <div class="panel-heading" style="background-color: rgba(48,63,159,0.5)" href="#today_body" data-toggle="collapse">
                        <h4 class="panel-title">
                            <a href="#today_body" data-toggle="collapse">Today</a>
                            <span class="badge pull-right">{!!count($today)!!} Reminder/s</span>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="today_body" >
                        <div class="panel-body">
                        @if (!count($today))
                            <div class="center-block"><h2>No Reminders for Now</h2></div>
                        @else   
                            <div class="list-group">
                                @foreach ($today as $t)
                                    <a href="{!! url('reminders')!!}/{!!$t->id!!}" class="list-group-item">{!! $t->title !!}<label class="{!!$t->tag->style!!} pull-right">{!!$t->tag->name!!}</label></a>
                                @endforeach
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="panel" style="background-color: rgba(220,237,200,0.5)">
                    <div class="panel-heading" style="background-color: rgba(100,221,23,0.5)" href="#upcoming_body" data-toggle="collapse">
                        <h4 class="panel-title">
                            <a href="#upcoming_body" data-toggle="collapse">Upcoming</a>
                            <span class="badge pull-right">{!!count($upcoming)!!} Reminder/s</span>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="upcoming_body" >
                        <div class="panel-body">
                        @if (!count($upcoming))
                            <div class="center-block"><h2>No upcoming Reminders</h2></div>
                        @else
                             <div class="list-group">
                                 @foreach ($upcoming as $u)
                                    <a href="{!! url('reminders')!!}/{!!$u->id!!}" class="list-group-item">{!! $u->title !!}<label class="{!!$u->tag->style!!} pull-right">{!!$u->tag->name!!}</label></a>
                                 @endforeach
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop