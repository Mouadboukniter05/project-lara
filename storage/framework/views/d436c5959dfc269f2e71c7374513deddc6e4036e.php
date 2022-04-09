<?php $__env->startSection('content'); ?>

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL Reports</h1>
    </div>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
         <th>User</th>
         <th>Title</th>
         <th>Action</th>
      </tr>
    </thead>

<?php if( !$reports->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e(Carbon\Carbon::parse($report->created_at)->format('m-d-Y')); ?></td>

        <td>
         
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $report->user_id ): ?>
                <span class="label label-info"> <?php echo e($user->name); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td><?php echo e($report->raport_title); ?> </td>

        <td>
            <a href="<?php echo e(route('report.view', ['id' => $report->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
        <?php if( Auth::user()->post=='manager'): ?>
            <a href="<?php echo e(route('report.delete', ['id' => $report->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            <?php endif; ?>
        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>


<?php else: ?> 
    <p><em>There are no tasks assigned yet</em></p>
<?php endif; ?>


</table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>