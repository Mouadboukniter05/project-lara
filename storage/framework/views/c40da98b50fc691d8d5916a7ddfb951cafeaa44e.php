<?php $__env->startSection('content'); ?>

<h1>Check List for:  "<?php echo e($c_name->cust_f_name); ?> <?php echo e($c_name->cust_l_name); ?>" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        
        <th>Check Amount DH</th>
        
        <th>Priority </th>
        <th>Comment </th>
        <th>Status </th>
        <th>Actions</th>
      </tr>
    </thead>

<?php if( !$check_list->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $check_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($check->beneficiary); ?> </td>
        <td><?php echo e($check->amount); ?> </td>
        
        
        
        <td>
            <?php if( !$check->completed ): ?>
                <a href="<?php echo e(route('check.completed', ['id' => $check->id])); ?>" class="btn btn-warning"> Mark as Cash check</a>
            <?php else: ?>
                <span class="label label-success">Cash check</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if( $check->priority == 0 ): ?>
                <span class="label label-info">Taken</span>
            <?php else: ?>
                <span class="label label-danger">Given</span>
            <?php endif; ?>
        </td>
        <td><?php echo e($check->coment); ?> </td>

        <td>
            <a href="<?php echo e(route('check.view', ['id' => $check->id])); ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
            <a href="<?php echo e(route('check.delete', ['id' => $check->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            <?php endif; ?>

        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>There are no Check assigned yet</em></p>
<?php endif; ?>


</table>



<div class="btn-group">
    <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Go Back</a>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>