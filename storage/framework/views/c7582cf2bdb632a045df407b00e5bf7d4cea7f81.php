<?php $__env->startSection('content'); ?>

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL Check</h1>
    </div>

    <div class="col-md-6">
       
    </div> 

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th>Check Beneficiary  </th>
        <th>Check Amount </th>
        <th>Assigned To </th>
         <th> Customer</th>
        <th>Priority </th>
        <th>Comment </th>
        <th>Status </th>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
        <th>Actions</th>
        <?php endif; ?>
      </tr>
    </thead>

<?php if( !$checks->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e(Carbon\Carbon::parse($check->created_at)->format('m-d-Y')); ?></td>
        <td><?php echo e($check->beneficiary); ?> </td>
        <td><?php echo e($check->amount); ?> DH </td>

        <td>
         
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $check->user_id ): ?>
                    <a href="<?php echo e(route('user.list', [ 'id' => $user->id ])); ?>"><?php echo e($user->name); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $customer->id == $check->customer_id ): ?>
                <span class="label label-jc"><?php echo e($customer->cust_f_name); ?><?php echo e($customer->cust_l_name); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
            
            

        

        <td>
            <?php if( $check->priority == 0 ): ?>
                <span class="label label-info">Taken</span>
            <?php else: ?>
                <span class="label label-danger">Given</span>
            <?php endif; ?>
        </td>
        <td><?php echo e($check->coment); ?> </td>

        <td>
            <?php if( !$check->completed ): ?>
                <a href="<?php echo e(route('check.completed', ['id' => $check->id])); ?>" class="btn btn-warning"> Mark as cash check</a>
                <span class="label label-danger"><?php echo e(( $check->duedate < Carbon\Carbon::now() )  ? "!" : ""); ?></span>
            <?php else: ?>
                <span class="label label-success">Cash check</span>
            <?php endif; ?>
  
            

        </td>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
        <td>
            <a href="<?php echo e(route('check.view', ['id' => $check->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            <!-- <a href="<?php echo e(route('check.edit', ['id' => $check->id])); ?>" class="btn btn-primary"> edit </a>  -->
            <a href="<?php echo e(route('check.delete', ['id' => $check->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
        <?php endif; ?>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php echo e($checks->links()); ?>



<?php else: ?> 
    <p><em>There are no Check assigned yet</em></p>
<?php endif; ?>


</table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>