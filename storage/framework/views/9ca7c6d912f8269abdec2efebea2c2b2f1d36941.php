<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<form id="project_form" action="<?php echo e(route('customer.update', [ 'id' => $edit_cust->id ])); ?>" method="POST">
    <?php echo e(csrf_field()); ?>


<label><?php echo e(__('messages.Edit_Customer')); ?>  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></label>

<div class="row">
    <div class="col-md-8">
		
        <div class="form-group">
            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.E_C_First_Name')); ?>" name="cust_f_name" value="<?php echo e($edit_cust->cust_f_name); ?>">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="<?php echo e(__('messages.E_C_Last_Name')); ?>" name="cust_l_name" value="<?php echo e($edit_cust->cust_l_name); ?>">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="<?php echo e(__('messages.E_C_Phone_number')); ?>" name="cust_phone" value="<?php echo e($edit_cust->cust_phone); ?>">
    </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="<?php echo e(__('messages.E_C_Email')); ?>" name="cust_email" value="<?php echo e($edit_cust->cust_email); ?>">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="<?php echo e(__('messages.E_C_Status')); ?>" name="cust_status" value="<?php echo e($edit_cust->cust_status); ?>">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="<?php echo e(__('messages.E_C_Adress')); ?>" name="cust_adress" value="<?php echo e($edit_cust->cust_adress); ?>">
    </div>
		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="<?php echo e(__('messages.Submit')); ?>" onclick="return validateForm()">
			<a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
		</div>
	</div>
</div>

</form>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>