<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="col-md-2">
    <?php if(count($public)): ?>
        <br>
    <button data-toggle="collapse" data-target="#publicreminders" class="btn btn-info btn-sm" style="width:100%; margin-bottom: 30px">View Public Reminders</button>
    <?php else: ?>
        <br><br><br><br>
    <?php endif; ?>
        <a href="<?php echo url('reminders'); ?>" class="btn btn-success btn-lg" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-home" style="font-size:40px"></span><br>
            Home
        </a>
        <a href="<?php echo url('users'); ?>/<?php echo Auth::user()->id; ?>" class="btn btn-warning btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-user" style="font-size:40px"></span><br>
            Profile
        </a>
        <a href="<?php echo url('reminders/create'); ?>" class="btn btn-danger btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-pushpin" style="font-size:40px"></span><br>
            Add Reminder
        </a>
        <a href="<?php echo url('/logout'); ?>" class="btn btn-primary btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-log-out" style="font-size:40px"></span><br>
            Logout
        </a>
    </div>
    <div class="col-md-offset-1 col-md-8">
        <div class="row" style="height: 80px">
                <?php if(Session::has('flash_notification.message')): ?>
                    <div class="alert alert-<?php echo Session::get('flash_notification.level'); ?> fade in" style="margin-top: 10px" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo Session::get('flash_notification.message'); ?>

                    </div>
                <?php endif; ?>
        </div>
        <div class="row">
            <div class="panel-group">
                <?php if(count($public)): ?>
                    <div class="panel panel-collapse collapse" style="background-color: rgba(225,190,231,0.5)" id="publicreminders">
                        <div class="panel-heading" style="background-color: rgba(156,39,176,0.5)">Public</div>
                        <div class="panel-body">
                             <div class="list-group">
                                <?php foreach($public as $p): ?>
                                    <a href="<?php echo url('reminders'); ?>/<?php echo $p->id; ?>" class="list-group-item"><?php echo $p->title; ?><label class="<?php echo $p->tag->style; ?> pull-right"><?php echo $p->tag->name; ?></label></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(count($overdue)): ?>
                    <div class="panel" style="background-color: rgba(255,205,210,0.5)">
                        <div class="panel-heading" style="background-color: rgba(229,57,53,0.5)" href="#overdue_body" data-toggle="collapse">
                            <h4 class="panel-title">
                                <a href="#overdue_body" data-toggle="collapse">Overdue</a>
                                <span class="badge pull-right"><?php echo count($overdue); ?> Reminder/s</span>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse in" id="overdue_body" >
                            <div class="panel-body" >
                                 <div class="list-group">
                                     <?php foreach($overdue as $o): ?>
                                        <a href="<?php echo url('reminders'); ?>/<?php echo $o->id; ?>" class="list-group-item"><?php echo $o->title; ?><label class="<?php echo $o->tag->style; ?> pull-right"><?php echo $o->tag->name; ?></label></a>
                                     <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="panel" style="background-color: rgba(227,242,253,0.5)">
                    <div class="panel-heading" style="background-color: rgba(48,63,159,0.5)" href="#today_body" data-toggle="collapse">
                        <h4 class="panel-title">
                            <a href="#today_body" data-toggle="collapse">Today</a>
                            <span class="badge pull-right"><?php echo count($today); ?> Reminder/s</span>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="today_body" >
                        <div class="panel-body">
                        <?php if(!count($today)): ?>
                            <div class="center-block"><h2>No Reminders for Now</h2></div>
                        <?php else: ?>   
                            <div class="list-group">
                                <?php foreach($today as $t): ?>
                                    <a href="<?php echo url('reminders'); ?>/<?php echo $t->id; ?>" class="list-group-item"><?php echo $t->title; ?><label class="<?php echo $t->tag->style; ?> pull-right"><?php echo $t->tag->name; ?></label></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="panel" style="background-color: rgba(220,237,200,0.5)">
                    <div class="panel-heading" style="background-color: rgba(100,221,23,0.5)" href="#upcoming_body" data-toggle="collapse">
                        <h4 class="panel-title">
                            <a href="#upcoming_body" data-toggle="collapse">Upcoming</a>
                            <span class="badge pull-right"><?php echo count($upcoming); ?> Reminder/s</span>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="upcoming_body" >
                        <div class="panel-body">
                        <?php if(!count($upcoming)): ?>
                            <div class="center-block"><h2>No upcoming Reminders</h2></div>
                        <?php else: ?>
                             <div class="list-group">
                                 <?php foreach($upcoming as $u): ?>
                                    <a href="<?php echo url('reminders'); ?>/<?php echo $u->id; ?>" class="list-group-item"><?php echo $u->title; ?><label class="<?php echo $u->tag->style; ?> pull-right"><?php echo $u->tag->name; ?></label></a>
                                 <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>