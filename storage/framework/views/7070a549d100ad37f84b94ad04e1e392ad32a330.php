<?php $__env->startSection('content'); ?>


<form action="<?php echo e(route('user.update', [ 'id' => $user->id ] )); ?>" method="POST">
    <?php echo e(csrf_field()); ?>



    <div class="col-md-8">

    	<div class="form-group">
    		<label>Edit Name</label>
			<input type="text" class="form-control"  name="name" value="<?php echo e($user->name); ?>">
		</div>

    	<div class="form-group">
    		<label>Edit Email</label>
			<input type="text" class="form-control"  name="email" value="<?php echo e($user->email); ?>">
		</div>
		<div class="form-group">
    		<label>Edit Phone</label>
			<input type="text" class="form-control"  name="phone" value="<?php echo e($user->phone); ?>">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Update User Password (optional)" name="password">
		</div>

	</div>

	<div class="col-md-4">

		<div class="form-group">
			
			<label>Edit Work Post </label>
			<?php if( Auth::user()->post=='manager' ): ?>
			<select name="post" class="form-control">
				<?php if( $user->post == 'operation' ): ?>
				<option value="operation" selected>Operation</option>
				<option value="manager">Management</option>
				<option value="multimedia">Multimedia</option>
				<option value="audit">Audit</option>
				<?php endif; ?>
			  	<?php if($user->post == 'manager'): ?>
				  <option value="operation" >Operation</option>
				  <option value="manager" selected>Management</option>
				  <option value="multimedia">Multimedia</option>
				  <option value="audit">Audit</option>			  
				  <?php endif; ?>
				  <?php if($user->post == 'multimedia'): ?>
				  <option value="operation" >Operation</option>
				  <option value="manager" >Management</option>
				  <option value="multimedia"selected>Multimedia</option>
				  <option value="audit">Audit</option>			  
				  <?php endif; ?>
				  <?php if($user->post == 'audit'): ?>
				  <option value="operation" >Operation</option>
				  <option value="manager" >Management</option>
				  <option value="multimedia">Multimedia</option>
				  <option value="audit"selected>Audit</option>			  
				  <?php endif; ?>
			</select>
			<?php else: ?>
			<select name="post" class="form-control">
			<option value="<?php echo e($user->post); ?>"selected>You Cant Edit Post</Em></option>
			</select>
			<?php endif; ?>
		</div>

		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit">
			<a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Go Back</a>
		</div>

	</div>




</form>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>