<?php $__env->startSection('content'); ?>

<h1>Project Project List for:  "<?php echo e($c_name->cust_f_name); ?> <?php echo e($c_name->cust_l_name); ?>" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Project Title</th>
        <th>Customer Name</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

<?php if( !$projet_list->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $projet_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($projet->projet_title); ?> </td>
        <td><?php echo e($projet->customer->cust_f_name); ?> <?php echo e($projet->customer->cust_l_name); ?></td>
        <td>
            <?php if( $projet->priority == 0 ): ?>
                <span class="label label-info">Normal</span>
            <?php else: ?>
                <span class="label label-danger">High</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if( !$projet->completed ): ?>
                <a href="<?php echo e(route('projet.completed', ['id' => $projet->id])); ?>" class="btn btn-warning"> Mark as completed</a>
            <?php else: ?>
                <span class="label label-success">Completed</span>
            <?php endif; ?>
        </td>
        <td>
            <!-- <a href="<?php echo e(route('projet.edit', ['id' => $projet->id])); ?>" class="btn btn-primary"> edit </a> -->
            <a href="<?php echo e(route('projet.view', ['id' => $projet->id])); ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
        <?php if( Auth::user()->post=='manager'): ?>
            <a href="<?php echo e(route('projet.delete', ['id' => $projet->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            <?php endif; ?>
        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>There are no project assigned yet</em></p>
<?php endif; ?>


</table>



<div class="btn-group">
    <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Go Back</a>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>