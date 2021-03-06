<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="col-md-2">
    <br><br><br><br>
        <a href="<?php echo url('reminders'); ?>" class="btn btn-success btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-home" style="font-size:40px"></span><br>
            Home
        </a>
        <a href="<?php echo url('users'); ?>/<?php echo Auth::user()->id; ?>" class="btn btn-warning btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-user" style="font-size:40px"></span><br>
            Profile
        </a>
        <a href="<?php echo url('reminders/create'); ?>" class="btn btn-danger btn-lg" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-pushpin" style="font-size:40px"></span><br>
            Add Reminder
        </a>
        <a href="<?php echo url('/logout'); ?>" class="btn btn-primary btn-xs" style="width: 100%; margin-bottom: 30px">
            <span class="glyphicon glyphicon-log-out" style="font-size:40px"></span><br>
            Logout
        </a>
    </div>
    <div class="col-md-offset-2 col-md-5" style="margin-top: 80px">
        <div class="panel panel-warning">
            <div class="panel-heading">Update Note</div>
            <div class="panel-body">
               <?php echo Form::open(array('route' => array('notes.update', $notes->first()->id), 'data-toggle' => 'validator')); ?>

               <?php echo csrf_field(); ?>

               <?php echo method_field('PATCH'); ?>

                <div class="form-group">
                    <?php echo Form::text('title', $notes->first()->title, array('class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required', 'data-error' => 'Title must not be empty')); ?>

                    <div class="help-block with-errors">
                        <?php if($errors->has('title')): ?>
                            <?php echo $errors->first('title'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::textarea('body',$notes->first()->body, array('class' => 'form-control', 'placeholder' => 'Body','rows' => '3', 'style' => 'resize: vertical', 'required' => 'required', 'data-error' => 'Body must not be empty')); ?>

                    <div class="help-block with-errors">
                            <?php if($errors->has('body')): ?>
                                <?php echo $errors->first('body'); ?>

                            <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning form-control">
                    <span class="glyphicon glyphicon-wrench"></span>
                    Update
                </button>
               <?php echo Form::close(); ?> 
            </div>
        </div>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>