<?php $__env->startSection('content'); ?>
<div class="container">
    <br><br><br>
    <div class="panel-group col-md-5">
        <div class="panel panel-info">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
               <?php echo Form::open(['url' => 'login', 'method' => 'post', 'data-toggle' => 'validator']); ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <?php echo Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required', 'data-error' => 'Invalid Username')); ?>

                    </div>
                    <div class="help-block with-errors">
                        <?php if($errors->has('username')): ?>
                            <?php echo $errors->first('username'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-plus"></span></span>
                        <?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'required' => 'requried', 'data-error' => 'Invalid Password')); ?>

                        <?php echo csrf_field(); ?>

                    </div>
                    <div class="help-block with-errors">
                        <?php if($errors->has('password')): ?>
                            <?php echo $errors->first('password'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <p class="help-block" style="font-size: smaller; color: red;">
                    <?php if($errors->has('login')): ?>  
                        <?php echo $errors->first('login'); ?>

                    <?php endif; ?>
                </p>
                <button type="submit" class="btn btn-info form-control">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Login
                </button>
               <?php echo Form::close(); ?> 
            </div>
        </div>
        <br/>
        <br/>
        <div class="panel panel-success">
            <div class="panel-heading">Signup</div>
            <div class="panel-body">
                 <?php echo Form::open(['url' => 'register', 'method' => 'get','data-toggle' => 'validator']); ?>

                 <?php echo csrf_field(); ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <?php echo Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username','required' => 'required', 'data-error' => 'Username must not be blank', 'id' => 'userName')); ?>

                    </div>
                    <div class="help-block with-errors" id="checker">
                        <?php if($errors->has('username')): ?>
                            <?php echo $errors->first('username'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-plus"></span></span>
                        <?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password','required' => 'required', 'data-error' => 'Password must not be blank')); ?>

                    </div>
                    <div class="help-block with-errors">
                        <?php if($errors->has('password')): ?>
                            <?php echo $errors->first('password'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success form-control">
                    <span class="glyphicon glyphicon-user"></span>
                    Sign up!
                </button>
               <?php echo Form::close(); ?> 
            </div>
        </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>