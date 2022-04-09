<?php $__env->startSection('content'); ?>

<h1>Create Check List for:  "<?php echo e($username->name); ?>" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th>Check Beneficiary</th>
        <th>Check Amount</th>
        <th>Customer</th>        
        <th>Priority</th>
        <th>Comment</th>
        <th>Status</th>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
        <th>Actions</th>
        <?php endif; ?>
      </tr>
    </thead>

<?php if( !$check_list->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $check_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($check->created_at); ?> </td>
        <td><?php echo e($check->beneficiary); ?> </td>
        <td><?php echo e($check->amount); ?> </td>
        <td>
             <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($check->customer_id == $customer->id): ?>
            <?php echo e($customer->cust_f_name); ?> <?php echo e($customer->cust_l_name); ?>

            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td>
            <?php if( $check->priority == 0 ): ?>
                <span class="label label-info">Token</span>
            <?php else: ?>
                <span class="label label-danger">Given</span>
            <?php endif; ?>
        </td>
        <td><?php echo e($check->coment); ?> </td>

        <td>
            <?php if( !$check->completed ): ?>
                <a href="<?php echo e(route('check.completed', ['id' => $check->id])); ?>" class="btn btn-warning"> Mark as Cash check</a>
            <?php else: ?>
                <span class="label label-success">Cash check</span>
            <?php endif; ?>
        </td>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>

        <td>
            
            <a href="<?php echo e(route('check.view', ['id' => $check->id])); ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
            <a href="<?php echo e(route('check.delete', ['id' => $check->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
        <?php endif; ?>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>There are no check assigned yet</em></p>
<?php endif; ?>


</table>



<div class="btn-group">
    <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Go Back</a>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>