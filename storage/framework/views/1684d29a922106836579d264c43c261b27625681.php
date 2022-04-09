<?php $__env->startSection('content'); ?>

<h1><?php echo e(__('messages.CONTACTS_MESSAGES')); ?></h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th><?php echo e(__('messages.Name')); ?></th>
        <th><?php echo e(__('messages.Email')); ?></th>
        <th><?php echo e(__('messages.Time')); ?></th>
        <th><?php echo e(__('messages.Actions')); ?></th>
      </tr>
    </thead>

<?php if( !$contacts->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($contact->cont_name); ?> </td>
        <td><?php echo e($contact->cont_email); ?></td>
        <td><?php echo e($contact->created_at); ?></td>
        <td>
            
            <a href="<?php echo e(route('contact.view', ['id' => $contact->id])); ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
            <a href="<?php echo e(route('contact.delete', ['id' => $contact->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>There are no Messages yet</em></p>
<?php endif; ?>


</table>








<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>