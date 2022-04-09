<?php $__env->startSection('content'); ?>
<div class="col-md-8">
<h4><strong><?php echo e(__('messages.subject')); ?> : </strong> <?php echo e($message->subject); ?> (<?php echo e($message->created_at ->diffForHumans()); ?>)</h5></h4>
<h4><strong><?php echo e(__('messages.Email')); ?> :</strong> <?php echo e($message->email); ?></h4>
<p ><br><br> <?php echo e($message->message); ?><br><br></p>
    <div class="btn-group">
        <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>