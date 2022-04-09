<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<h1>LIST OF CUSTOMER</h1>

<div class="new_project">
  <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='operation'): ?>
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New Customer</button>
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
        <form id="project_form" action="<?php echo e(route('customer.store')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>


        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <label>Create new Custemor <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Cudtomer First Name" name="cust_f_name" value="<?php echo e(old('cust_f_name')); ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Enter Customer Last Name" name="cust_l_name" value="<?php echo e(old('cust_l_name')); ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter costomer Phone number" name="cust_phone" value="<?php echo e(old('cust_phone')); ?>">
        </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter Customer Email" name="cust_email" value="<?php echo e(old('cust_email')); ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Enter Customer Status" name="cust_status" value="<?php echo e(old('cust_status')); ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Customer Adress" name="cust_adress" value="<?php echo e(old('cust_adress')); ?>">
        </div>
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



<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th> Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Status</th>
        <th>Adress</th>
        <th>Customer Project List</th>
        <th>Customer Check List</th>
        <th>Action</th>
      </tr>
    </thead>

<?php if( !$customers->isEmpty() ): ?> 
    <tbody>
    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($customer->cust_f_name); ?> <?php echo e($customer->cust_l_name); ?> </td>
        <td><?php echo e($customer->cust_phone); ?> </td>
        <td><?php echo e($customer->cust_email); ?> </td>
        <td><?php echo e($customer->cust_status); ?> </td>
        <td><?php echo e($customer->cust_adress); ?> </td>
        <td>
           <a href="<?php echo e(route('projet.list', [ 'customerid' => $customer->id ])); ?>">List all projet</a>
        </td>
        <td>
          <a href="<?php echo e(route('check.list', [ 'customerid' => $customer->id ])); ?>">List all check</a>
       </td>
        <td>
          <a class="btn btn-primary" href="<?php echo e(route('customer.edit', [ 'id' => $customer->id ])); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
          <a class="btn btn-danger" href="<?php echo e(route('customer.delete', [ 'id' => $customer->id ])); ?>" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;
       <?php endif; ?>
        </td> 

      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php else: ?> 
    <p><em>There are no Customers yet</em></p>
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