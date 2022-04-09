<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <h1><?php echo e(__('messages.USERS')); ?></h1>
    </div>
</div>


<div class="new_project">
    <?php if( Auth::user()->post=='manager'||Auth::user()->post=='super manager' ): ?>
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<?php echo e(__('messages.Add_User')); ?></button>
  <?php endif; ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(__('messages.User_Information')); ?></h4>
        </div>

        <div class="modal-body">
        <form id="task_form" action="<?php echo e(route('user.store')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="col-md-7">
                    <label><?php echo e(__('messages.Create_User')); ?> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.User_name')); ?> " name="name" value="<?php echo e(old('name')); ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.User_email')); ?>" name="email" value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.User_phone')); ?>" name="phone" value="<?php echo e(old('phone')); ?>">
                        </div>
                        

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo e(__('messages.User_Password')); ?>" name="password">
                        </div>

                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label><?php echo e(__('messages.Set_Status')); ?> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                        <select name="admin" class="form-control">
                            <option value="0" selected><?php echo e(__('messages.Disabled')); ?> (<?php echo e(__('messages.default')); ?>)</option>
                            <option value="1"><?php echo e(__('messages.Active')); ?></option>
                        </select>
                        <label><?php echo e(__('messages.Set_Post')); ?> </label>
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
                <input class="btn btn-primary" type="submit" value="<?php echo e(__('messages.Submit')); ?>" >
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('messages.Close')); ?></button>
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
        <th><?php echo e(__('messages.Name')); ?></th>
        <th><?php echo e(__('messages.Post')); ?></th>
        <th><?php echo e(__('messages.Email')); ?></th>
        <th><?php echo e(__('messages.Phone')); ?></th>
        <?php if( Auth::user()->post=='manager' ||Auth::user()->post=='super manager'): ?>
             <th><?php echo e(__('messages.Status')); ?></th>
        <th><?php echo e(__('messages.Actions')); ?></th>
        <?php endif; ?>
        
       
      </tr>
    </thead>

<?php if( !$users->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
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
            <?php if( $user->post =='super manager'): ?>
            Super Manager
            <?php endif; ?>
        </td>
        <td><?php echo e($user->email); ?></td>
        <td><?php echo e($user->phone); ?></td>
        <?php if( Auth::user()->post=='manager' &&( $user->post != 'manager')&&( $user->post != 'super manager')): ?>
        <td>
            <?php if( !$user->admin ): ?>
                <a href="<?php echo e(route('user.activate', ['id' => $user->id])); ?>" class="btn btn-warning"> <?php echo e(__('messages.Activate')); ?> <?php echo e(__('messages.user')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.disable', ['id' => $user->id])); ?>" class="btn btn-warning"> <?php echo e(__('messages.Disabled')); ?> <?php echo e(__('messages.user')); ?></a>
                <span class="label label-success"><?php echo e(__('messages.Active')); ?></span>
            <?php endif; ?>
        </td>
        <?php endif; ?>
        <?php if( Auth::user()->post=='manager' &&( $user->post == 'manager')): ?>
        <td> </td>
        <?php endif; ?>
        <?php if( Auth::user()->post=='super manager'): ?>
        <td>
            <?php if( !$user->admin ): ?>
                <a href="<?php echo e(route('user.activate', ['id' => $user->id])); ?>" class="btn btn-warning"><?php echo e(__('messages.Activate')); ?> <?php echo e(__('messages.user')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.disable', ['id' => $user->id])); ?>" class="btn btn-warning"><?php echo e(__('messages.Disabled')); ?> <?php echo e(__('messages.user')); ?></a>
                <span class="label label-success"><?php echo e(__('messages.Active')); ?></span>
            <?php endif; ?>
        </td>
        <?php endif; ?>
        <td>
            <?php if( Auth::user()->post=='manager' &&( $user->post != 'manager')&&( $user->post != 'super manager')): ?>
            
            <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <?php endif; ?>
            <?php if( Auth::user()->post=='super manager' ||Auth::user()->id== $user->id ): ?>
            
            <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <?php endif; ?>
            <?php if( Auth::user()->post=='manager' &&( $user->post != 'manager')&&( $user->post != 'super manager')): ?>
           
            <a href="<?php echo e(route('user.delete', ['id' => $user->id])); ?>" class="btn btn-danger" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
         <?php endif; ?>
         <?php if(Auth::user()->post=='super manager'): ?>
           
            <a href="<?php echo e(route('user.delete', ['id' => $user->id])); ?>" class="btn btn-danger" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
         <?php endif; ?>
        </td>
        
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em><?php echo e(__('messages.no_users')); ?></em></p>
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