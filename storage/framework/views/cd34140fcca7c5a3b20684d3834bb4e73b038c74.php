<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<h1><?php echo e(__('messages.All_Messages')); ?></h1>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<?php echo e(__('messages.Create_Message')); ?></button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e(__('messages.Create_Message')); ?></h4>
      </div>
      <div class="modal-body">
        <form id="project_form" action="<?php echo e(route('message.store')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>


        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <label><?php echo e(__('messages.Send_To')); ?> </label>
              <div class="form-group">
                <select name="email" class="selectpicker" data-style="btn-primary" style="width:100%;">
                    <?php $__currentLoopData = $listcust; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->cust_email); ?>"><?php echo e($user->cust_email); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
            <label >
            title
            </label>
                <input class="form-control r" rows="10" id="title" name="title">
            </div>
            <div class="form-group">
                <textarea class="form-control r" rows="10" id="message" name="message"></textarea>
            </div>
            </div>
            
          </div>

        </div>
        
        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="<?php echo e(__('messages.Send')); ?>" >
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('messages.Close')); ?></button>
        </div>

        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th><?php echo e(__('messages.Time')); ?></th>
            <th><?php echo e(__('messages.From')); ?></th>
            <th><?php echo e(__('messages.subject')); ?></th>
            <th><?php echo e(__('messages.Actions')); ?></th>
          </tr>
        </thead>
    
    <?php if( !$messages->isEmpty() ): ?> 
        <tbody>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if( Auth::user()->post== 'super manager' || Auth::user()->post== 'manager' ): ?>
          <tr>
            <td><?php echo e(Carbon\Carbon::parse($message->created_at)->format('m-d-Y')); ?></td>
            <td>
                    <span class="label label-info"><?php echo e($message->email); ?></span>
            </td>
        <td> <?php echo e($message->subject); ?></td>
            
            <td>
            <a href="<?php echo e(route('letter.pola', ['id' => $message->id])); ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
              <a href="<?php echo e(route('message.delete', ['id' => $message->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    
            </td>
          </tr>
    <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    
        
    
    
    <?php else: ?> 
        <p><em><?php echo e(__('messages.no_Messages')); ?></em></p>
    <?php endif; ?>
    
    
    </table>
    </div>
    
    
    <?php $__env->stopSection(); ?>
<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Customer will also delete all Project associated with this project");
  if (x)
      return true;
  else
    return false;
}




</script>  

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>