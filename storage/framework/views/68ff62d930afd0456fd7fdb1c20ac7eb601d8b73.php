<?php $__env->startSection('content'); ?>

    






<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<div class="container">
    
<form id="check_form" action="<?php echo e(route('contact.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

   
    <div class="col-md-8">
        <label><?php echo e(__('messages.contactus')); ?></label>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.Name')); ?>" name="cont_name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.Email')); ?>" name="cont_email">
        </div>
        <div class="form-group">
            <textarea class="form-control r" rows="10" id="observation" name="cont_message"></textarea>
        </div>
        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="<?php echo e(__('messages.Send')); ?>" >
            
        </div>
        
    </div>

</form>
</div>



<?php $__env->stopSection(); ?>











<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>