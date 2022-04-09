<?php $__env->startSection('content'); ?>


<h1>Displaying Results for:  "<?php echo e($value); ?>" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Task Title</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

<?php if( !$tasks->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($task->task_title); ?> </td>
        <td>
            <?php if( $task->priority == 0 ): ?>
                <span class="label label-info">Normal</span>
            <?php else: ?>
                <span class="label label-danger">High</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if( !$task->completed ): ?>
                <a href="<?php echo e(route('task.completed', ['id' => $task->id])); ?>" class="btn btn-warning"> Mark as completed</a>
            <?php else: ?>
                <span class="label label-success">Completed</span>
            <?php endif; ?>
        </td>
        <td>
            <!-- <a href="<?php echo e(route('task.edit', ['id' => $task->id])); ?>" class="btn btn-primary"> edit </a> -->
            <a href="<?php echo e(route('task.view', ['id' => $task->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            <a href="<?php echo e(route('task.delete', ['id' => $task->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>No match found</em></p>
<?php endif; ?>


</table>



    <div class="btn-group">
        <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Go Back</a>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>