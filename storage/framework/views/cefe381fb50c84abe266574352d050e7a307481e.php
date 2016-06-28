<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="col-md-2">
    <br><br><br><br>
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
    <div class="col-md-10">
        <div class="col-md-12" style="height: 80px">
            <?php if(Session::has('flash_notification.message')): ?>
                <div class="alert alert-<?php echo Session::get('flash_notification.level'); ?> fade in" style="margin-top: 10px" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo Session::get('flash_notification.message'); ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center;">
                        <h2 class="panel-title"><?php echo $reminders->first()->title; ?></h2>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Form::label('body', 'Content:'); ?>

                        <?php echo Form::textarea('privacy',$reminders->first()->body, array('class' => 'form-control','readonly' => 'readonly','style' => 'resize:none','rows' => '3')); ?>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo Form::label('privacy', 'Privacy Setting:'); ?>

                                <?php echo Form::text('privacy',$reminders->first()->privacy, array('class' => 'form-control','readonly' => 'readonly')); ?>

                            </div>
                            <div class="col-md-4">
                               <?php echo Form::label('due_date', 'Due on:'); ?>

                               <?php echo Form::text('due_date',$reminders->first()->due_date, array('class' => 'form-control','readonly' => 'readonly')); ?>

                            </div>
                            <div class="col-md-4">
                                <?php echo Form::label('tag', 'Tag:'); ?>

                                <?php echo Form::text('tag', $reminders->first()->tag->name, ['class' => 'selectpicker form-control', 'readonly' => 'readonly']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                <div class="form-group clearfix">
                <?php if(Auth::user()->id == ($reminders->first()->user->id)): ?>
                    <?php echo Form::open(array('route' => array('reminders.destroy', $reminders->first()->id), 'data-toggle' => 'validator')); ?>

                        <?php echo csrf_field(); ?>

                        <?php echo method_field('DELETE'); ?>

                        <a href="<?php echo url('reminders'); ?>/<?php echo $reminders->first()->id; ?>/edit" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Edit</a>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete</button> 
                <?php endif; ?>
                    <a class="btn btn-info" data-toggle="collapse" data-target="#notes">Hide/Show Notes</a>
                    <a class="btn btn-success" data-toggle="collapse" data-target="#addnote"><span class="glyphicon glyphicon-pencil"></span>Add Note</a>
                    <?php echo Form::close(); ?>

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
                        <?php if(!count($notes)): ?>
                            <div class="center-block" id="noteinfo"><h2>No Notes</h2></div>
                        <?php endif; ?>
                        <div class="panel-group" id="accordion">
                            <?php foreach($notes as $note): ?>
                                <div class="panel panel-default " id="note_<?php echo $note->id; ?>">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $note->id; ?>"><?php echo $note->title; ?></a>
                                            <span class="pull-right"><small>by </small><span><a href="<?php echo url('users'); ?>/<?php echo e($note->user->id); ?>"><?php echo $note->user->username; ?></a></span></span>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="<?php echo $note->id; ?>">
                                        <div class="panel-body">
                                           <?php echo $note->body; ?>

                                        </div>
                                        <?php if(Auth::user()->id == ($note->user->id)): ?>
                                            <div class="panel-footer">
                                               <a href="<?php echo url('notes'); ?>/<?php echo $note->id; ?>/edit" class="btn btn-warning btn-xs">Edit</a>
                                               <button type="button" class="btn btn-danger btn-xs delete-button" value="<?php echo $note->id; ?>">Delete</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                               </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div id="addnote" class="collapse">
                        <?php echo Form::label('addnote', 'New Note:'); ?>

                        <?php echo Form::open(array('data-toggle' => 'validator', 'route' => 'notes.store', 'name' => 'addnote')); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <?php echo Form::text('title',null, array('class' => 'form-control','data-error' => 'Title must not be empty', 'placeholder' => 'Title', 'required' => 'required', 'id' => 'note_title')); ?>

                            <div class="help-block with-errors">
                                <?php if($errors->has('title')): ?>
                                    <?php echo $errors->first('title'); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Form::text('body',null, array('class' => 'form-control','style' => 'resize:vertical','rows' => '3', 'data-error' => 'Body must not be empty', 'required' => 'required', 'placeholder' => 'Body', 'id' => 'note_body')); ?>

                            <div class="help-block with-errors">
                                <?php if($errors->has('body')): ?>
                                    <?php echo $errors->first('body'); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Form::hidden('reminder_id',$reminders->first()->id,array('id' => 'reminder_id')); ?>

                            <button type="button" class="btn btn-primary" id="addbutton"><span class="glyphicon glyphicon-check"></span>Submit</button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>