<?php $__env->startSection('content'); ?>
<div class="col-md-8">
<h4><strong>From :</strong> <?php echo e($contacts->cont_name); ?>  (<?php echo e($contacts->created_at ->diffForHumans()); ?>)</h5></h4>
<h4><strong>Email :</strong> <?php echo e($contacts->cont_email); ?></h4>
<p ><br><br> <?php echo e($contacts->cont_message); ?><br><br></p>
    <div class="btn-group">
        <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>