<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <h1>USERS</h1>
    </div>
</div>


<div class="new_project">
    <?php if( Auth::user()->post=='manager' ): ?>
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New User</button>
  <?php endif; ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter User Information</h4>
        </div>

        <div class="modal-body">
        <form id="task_form" action="<?php echo e(route('user.store')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="col-md-7">
                    <label>Create new User <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter User Full Name" name="name" value="<?php echo e(old('name')); ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter User Email" name="email" value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter User phone" name="phone" value="<?php echo e(old('phone')); ?>">
                        </div>
                        

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter User Password" name="password">
                        </div>

                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label>Set Status <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                        <select name="admin" class="form-control">
                            <option value="0" selected>Disabled (default)</option>
                            <option value="1">Active</option>
                        </select>
                        <label>Set Post </label>
                        <select name="post" class="form-control">
                            <option value="operation" selected>Operation</option>
                            <option value="manager">Management</option>
                            <option value="multimedia">Multimedia</option>
                            <option value="audit">Audit</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" value="Submit" >
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>


        </form>
       </div>

    </div>

  </div>
</div>
<!--  END modal  -->





<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Post</th>
        <th>Email</th>
        <th>Phone</th>
        <?php if( Auth::user()->post=='manager' ): ?>
             <th>Status</th>
        <th>Actions</th>
        <?php endif; ?>
       
      </tr>
    </thead>

<?php if( !$users->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if( $user->id == 1 ): ?>  <?php continue; ?> 
    <?php endif; ?>
      <tr>
        <td><a href="<?php echo e(route('user.list', ['id'=> $user->id] )); ?>"><?php echo e($user->name); ?></a></td>

        <td><?php if( $user->post =='manager'): ?>
                Manager
            <?php endif; ?>
            <?php if( $user->post =='operation'): ?>
            Operation
            <?php endif; ?>
            <?php if( $user->post =='multimedia'): ?>
            Multimedia
            <?php endif; ?>
            <?php if( $user->post =='audit'): ?>
            Audit
            <?php endif; ?>
        </td>
        <td><?php echo e($user->email); ?></td>
        <td><?php echo e($user->phone); ?></td>
        <?php if( Auth::user()->post=='manager' ): ?>
        <td>
            <?php if( !$user->admin ): ?>
                <a href="<?php echo e(route('user.activate', ['id' => $user->id])); ?>" class="btn btn-warning"> Activate User</a>
            <?php else: ?>
                <a href="<?php echo e(route('user.disable', ['id' => $user->id])); ?>" class="btn btn-warning"> Disable User</a>
                <span class="label label-success">Active</span>
            <?php endif; ?>
        </td>
        <?php endif; ?>
        <td>
            <?php if( Auth::user()->post=='manager' || Auth::user()->id == $user->id ): ?>
            
            <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <?php endif; ?>
            <?php if( Auth::user()->post=='manager' ): ?>
           
            <a href="<?php echo e(route('user.delete', ['id' => $user->id])); ?>" class="btn btn-danger" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
         <?php endif; ?>
        </td>
        
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>There are no users yet</em></p>
<?php endif; ?>


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