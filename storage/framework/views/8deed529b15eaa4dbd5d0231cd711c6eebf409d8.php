<?php $__env->startSection('content'); ?>

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL TASKS</h1>
    </div>

    <div class="col-md-6">
        <form action="<?php echo e(route('task.search')); ?>" class="navbar-form" role="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search in Tasks..." name="search_task">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search">
                            <span class="sr-only">Search...</span>
                        </span>
                    </button>
                </span>
            </div>
        </form>
    </div> 

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th><a href="<?php echo e(route('task.sort', [ 'key' => 'task' ])); ?>">Task Title <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Assigned To / Project</th>
        <th><a href="<?php echo e(route('task.sort', [ 'key' => 'priority' ])); ?>">Priority <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th><a href="<?php echo e(route('task.sort', [ 'key' => 'completed' ])); ?>">Status <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Actions</th>
      </tr>
    </thead>

<?php if( !$tasks->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e(Carbon\Carbon::parse($task->created_at)->format('m-d-Y')); ?></td>
        <td><?php echo e($task->task_title); ?> </td>

        <td>
         
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $task->user_id ): ?>
                    <a href="<?php echo e(route('user.list', [ 'id' => $user->id ])); ?>"><?php echo e($user->name); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <span class="label label-jc"><?php echo e($task->project->project_name); ?></span>

        </td>

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
                <span class="label label-danger"><?php echo e(( $task->duedate < Carbon\Carbon::now() )  ? "!" : ""); ?></span>
            <?php else: ?>
                <span class="label label-success">Completed</span>
            <?php endif; ?>
  
            

        </td>
        <td>
            <a href="<?php echo e(route('task.view', ['id' => $task->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            <!-- <a href="<?php echo e(route('task.edit', ['id' => $task->id])); ?>" class="btn btn-primary"> edit </a>  -->
            <a href="<?php echo e(route('task.delete', ['id' => $task->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php echo e($tasks->links()); ?>



<?php else: ?> 
    <p><em>There are no tasks assigned yet</em></p>
<?php endif; ?>


</table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>