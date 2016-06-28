<?php $__env->startSection('content'); ?>
    <div id="sample">
        sadasdas
    </div>
    <a href="<?php echo e(url('reminders/3')); ?>" id="page">Go here</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>