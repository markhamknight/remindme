<!DOCTYPE html>
<html>
<head>
    <title>RemindMe</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/css/app.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/css/bootstrap-select.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/css/bootstrap-datepicker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/css/bootstrap-datepicker.standalone.css')); ?>">
    <style>
        #bg {
            background-image: url(<?php echo e(URL::asset('/images/bg.png')); ?>);
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: fixed;
        }
         body {
            background-image: url(<?php echo e(URL::asset('/images/bg.png')); ?>);
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: fixed;
        }
    </style>
</head>
<body>
    
        <?php echo $__env->yieldContent('navigation'); ?>
        
        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->yieldContent('footer'); ?>
  
</body>
<script src="<?php echo e(url('/js/jquery.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(url('/js/bootstrap.min.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(url('/js/bootstrap-select.js')); ?>" type="text/javascript" charset="utf-8" ></script>
<script src="<?php echo e(url('/js/bootstrap-datepicker.js')); ?>" type="text/javascript" charset="utf-8"  defer></script>
<script src="<?php echo e(url('/js/validator.js')); ?>" type="text/javascript" charset="utf-8" ></script>
<script src="<?php echo e(url('/js/other.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(url('/js/ajax.js')); ?>" type="text/javascript" charset="utf-8"></script>

</html>