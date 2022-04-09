<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<h1><?php echo e(__('messages.All_Messages')); ?></h1>




<!--  END modal  -->

<div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><?php echo e(__('messages.Time')); ?></th>
          <th><?php echo e(__('messages.to')); ?></th>
          <th><?php echo e(__('messages.Message')); ?></th>
          <th><?php echo e(__('messages.Actions')); ?></th>
        </tr>
      </thead>
    
    <?php if( !$messages->isEmpty() ): ?> 
        <tbody>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if( Auth::user()->id== $message->user_id ): ?>
          <tr>
            <td><?php echo e(Carbon\Carbon::parse($message->created_at)->format('m-d-Y')); ?></td>
            
        <td> <span class="label label-info"><?php echo e($message->email); ?></span></td>

        <td> <?php echo e($message->message); ?></td>
            
            <td>
                <a href="<?php echo e(route('boit_message.delete', ['id' => $message->id])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    
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