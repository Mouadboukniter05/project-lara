<?php $__env->startSection('content'); ?>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Work Post</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if( $user->id == 1 ): ?>  <?php continue; ?> 
    <?php endif; ?>
      <tr>
        <td><a href="<?php echo e(route('user.list', ['id'=> $user->id] )); ?>"><?php echo e($user->name); ?></a></td>

        <td><?php echo e($user->email); ?></td>
        <td><?php echo e($user->phone); ?></td>
        <td>
            <?php if($user->post =='manager'): ?>
                Manager
            <?php endif; ?>
            <?php if($user->post =='operation'): ?>
            Operation
            <?php endif; ?>
            <?php if($user->post =='multimedia'): ?>
            Multimedia
            <?php endif; ?>
            <?php if($user->post =='audit'): ?>
            Audit
            <?php endif; ?>
        </td>
    
        <td>
            <?php if( !$user->admin ): ?>
                <a href="<?php echo e(route('user.activate', ['id' => $user->id])); ?>" class="btn btn-warning"> Activate User</a>
            <?php else: ?>
                <a href="<?php echo e(route('user.disable', ['id' => $user->id])); ?>" class="btn btn-warning"> Disable User</a>
                <span class="label label-success">Active</span>
            <?php endif; ?>
        </td>
        <td>
            <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
 
            <a href="<?php echo e(route('user.delete', ['id' => $user->id])); ?>" class="btn btn-danger" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>



</table>



<?php $__env->stopSection(); ?>

<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a User will also delete all tasks associated.");
  if (x)
      return true;
  else
    return false;
}




</script>  


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>