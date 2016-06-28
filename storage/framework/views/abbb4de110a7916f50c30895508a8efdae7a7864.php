<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="col-md-2">
    <br><br><br><br>
        <a href="<?php echo url('reminders'); ?>" class="btn btn-success btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-home" style="font-size:40px"></span><br>
            Home
        </a>
        <a href="<?php echo url('users'); ?>/<?php echo Auth::user()->id; ?>" class="btn btn-warning btn-lg" style="width: 100%; margin-bottom: 30px">
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
    <div class="col-md-offset-2 col-md-5">
        <div class="row" style="height: 80px">
                <?php if(Session::has('flash_notification.message')): ?>
                    <div class="alert alert-<?php echo Session::get('flash_notification.level'); ?> fade in" style="margin-top: 10px" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo Session::get('flash_notification.message'); ?>

                    </div>
                <?php endif; ?>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
            <?php if($users->first()->id == Auth::user()->id): ?>
                <?php echo Form::open(array('route' => array('users.update', $users->first()->id), 'data-toggle' => 'validator','files' => 'true')); ?>

               <?php echo csrf_field(); ?>

               <?php echo method_field('PATCH'); ?>

               <div class="form-group">
                   <div class="center-block" style="width: 150px;height: 150px; 5px solid black">
                       <img src="<?php echo URL::asset($file); ?>" width="150px" height="150px">
                   </div>
               </div>
               <div class="form-group">
               <div class="center-block">
                    <?php echo Form::label('profile_photo', 'Change Profile Photo'); ?>

                    <?php echo Form::file('profile_photo'); ?>

                </div>
               </div>
                <div class="form-group">
                    <?php echo Form::label('username', 'Username'); ?>

                    <?php echo Form::text('username', $users->first()->username, array('class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required', 'data-error' => 'Username must not be empty')); ?>

                    <div class="help-block with-errors">
                        <?php if($errors->has('username')): ?>
                            <?php echo $errors->first('username'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo Form::label('first_name', 'First Name'); ?>

                            <?php echo Form::text('first_name',$users->first()->first_name, array('class' => 'form-control', 'placeholder' => 'First Name')); ?>

                        </div>
                        <div class="col-md-6">
                            <?php echo Form::label('last_name', 'Last Name'); ?>

                            <?php echo Form::text('last_name',$users->first()->last_name, array('class' => 'form-control', 'placeholder' => 'Last Name')); ?>

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info form-control">
                    <span class="glyphicon glyphicon-wrench"></span>
                    Update
                </button>
               <?php echo Form::close(); ?>

            <?php else: ?>
                <div class="form-group">
                   <div class="center-block" style="width: 150px;height: 150px; 5px solid black">
                       <img src="<?php echo URL::asset($file); ?>" width="150px" height="150px">
                   </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('username', 'Username'); ?>

                    <?php echo Form::text('username', $users->first()->username, array('class' => 'form-control', 'readonly' => 'readonly')); ?>

                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo Form::label('first_name', 'First Name'); ?>

                            <?php echo Form::text('first_name',$users->first()->first_name, array('class' => 'form-control', 'readonly' => 'readonly')); ?>

                        </div>
                        <div class="col-md-6">
                            <?php echo Form::label('last_name', 'Last Name'); ?>

                            <?php echo Form::text('last_name',$users->first()->last_name, array('class' => 'form-control', 'readonly' => 'readonly')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>