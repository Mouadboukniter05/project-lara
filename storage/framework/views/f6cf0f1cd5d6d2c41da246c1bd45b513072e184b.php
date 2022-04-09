<?php $__env->startSection('content'); ?>

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL Project</h1>
    </div>

    <div class="col-md-6">
        <form action="<?php echo e(route('projet.search')); ?>" class="navbar-form" role="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search in projet..." name="search_projet">
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
        <th><a href="<?php echo e(route('projet.sort', [ 'key' => 'projet' ])); ?>">Projet Title <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Assigned To / Customer</th>
        <th>Priority </a></th>
        <th>Status </th>
        <th>Actions</th>
      </tr>
    </thead>

<?php if( !$projets->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $projets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e(Carbon\Carbon::parse($projet->created_at)->format('m-d-Y')); ?></td>
        <td><?php echo e($projet->projet_title); ?> </td>

        <td>
         
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $projet->user_id ): ?>
                    <a href="<?php echo e(route('user.list', [ 'id' => $user->id ])); ?>"><?php echo e($user->name); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <span class="label label-jc"><?php echo e($projet->customer->cust_f_name); ?> <?php echo e($projet->customer->cust_l_name); ?></span>

        </td>

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
                <span class="label label-danger"><?php echo e(( $projet->duedate < Carbon\Carbon::now() )  ? "!" : ""); ?></span>
            <?php else: ?>
                <span class="label label-success">Completed</span>
            <?php endif; ?>
  
            

        </td>
        <td>
            <a href="<?php echo e(route('projet.view', ['id' => $projet->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            <?php if( Auth::user()->post=='manager'): ?>
            <a href="<?php echo e(route('projet.delete', ['id' => $projet->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            <?php endif; ?>
        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php echo e($projets->links()); ?>



<?php else: ?> 
    <p><em>There are no project assigned yet</em></p>
<?php endif; ?>


</table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>