<?php $__env->startSection('content'); ?>

<h1><?php echo e(__('messages.Check_List_for')); ?>:  "<?php echo e($c_name->cust_f_name); ?> <?php echo e($c_name->cust_l_name); ?>" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th><?php echo e(__('messages.num')); ?></th>
        <th><?php echo e(__('messages.Created_At')); ?></th>
        <th><?php echo e(__('messages.Due_Date')); ?></th>
        <th><?php echo e(__('messages.Beneficiary')); ?> </th>
        <th><?php echo e(__('messages.Amount')); ?></th>
        <th><?php echo e(__('messages.Assigned_To')); ?> </th>
        <th><?php echo e(__('messages.Priority')); ?></th>
        
        <th><?php echo e(__('messages.Status')); ?> </th>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager'): ?>
        <th><?php echo e(__('messages.Actions')); ?></th>
        <?php endif; ?>
      </tr>
    </thead>

<?php if( !$check_list->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $check_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($check->id); ?> </td>

        <td><?php echo e(Carbon\Carbon::parse($check->created_at)->format('m-d-Y')); ?></td>
        <td><?php echo e(Carbon\Carbon::parse($check->duedate)->format('m-d-Y')); ?></td>
        <td><?php echo e($check->bank); ?> </td>
        <td><?php echo e($check->amount); ?> DH</td>
        <td>
         
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $check->user_id ): ?>
                    <a href="<?php echo e(route('user.list', [ 'id' => $user->id ])); ?>"><?php echo e($user->name); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td>
            <?php if( $check->priority == 0 ): ?>
                <span class="label label-info"><?php echo e(__('messages.Taken')); ?></span>
            <?php else: ?>
                <span class="label label-danger"><?php echo e(__('messages.Given')); ?></span>
            <?php endif; ?>
        </td>
        
        <td>
            <?php if( $check->completed== 0 ): ?>
                
                <span class="label label-danger"><?php echo e(__('messages.Impayé')); ?></span>
                <span class="label label-danger"><?php echo e(( $check->duedate < Carbon\Carbon::now() )  ? "!" : ""); ?></span>
            <?php endif; ?>
            <?php if($check->completed==1): ?>
                <span class="label label-success"><?php echo e(__('messages.Payer')); ?></span>
            <?php endif; ?>
            <?php if($check->completed==2): ?>
                <span class="label label-warning"><?php echo e(__('messages.Échanger')); ?></span>
            <?php endif; ?>
            <?php if($check->completed==3): ?>
                <span class="label label-primary"><?php echo e(__('messages.Annulé')); ?></span>
            <?php endif; ?>
            

        </td>
        
        

        <td>
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager'): ?>
        <a href="<?php echo e(route('check.view', ['id' => $check->id])); ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
            <a href="<?php echo e(route('check.delete', ['id' => $check->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            <?php endif; ?>

        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
<p><em><?php echo e(__('messages.no_Check')); ?></em></p>
<?php endif; ?>


</table>



<div class="btn-group">
    <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>