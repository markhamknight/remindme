<?php $__env->startSection('navigation'); ?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="<?php echo e(url('reminders')); ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-time"></span> Reminders</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">P
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container"  style="background-color: rgba(251,233,231,0.4); height: 85vh;">
    <div style="background-color: rgba(159,168,218,0.7); height: auto; width: auto">
        <h1 style="color:  #e040fb;font-size: 100px; text-align: center; ">Welcome</h1>
        <h1 style="color:  #e040fb;font-size: 100px; text-align: center"><?php echo e(Auth::user()->username); ?></h1>
    </div>
    
    <div style="margin: 0 auto; width: 500px">
        <a href="" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-wrench" style="font-size:40px"></span><br>Setup My Profile</a>
        <a href="" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-pushpin" style="font-size:40px"></span><br>Add a Reminder</a>
        <a href="" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-calendar" style="font-size:40px"></span><br>My Reminders</a>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>