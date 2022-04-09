<?php $__env->startSection('content'); ?>


<form action="<?php echo e(route('user.update', [ 'id' => $user->id ] )); ?>" method="POST">
    <?php echo e(csrf_field()); ?>



    <div class="col-md-8">

    	<div class="form-group">
    		<label> <?php echo e(__('messages.Name')); ?></label>
			<input type="text" class="form-control"  name="name" value="<?php echo e($user->name); ?>">
		</div>

    	<div class="form-group">
    		<label><?php echo e(__('messages.Email')); ?></label>
			<input type="text" class="form-control"  name="email" value="<?php echo e($user->email); ?>">
		</div>
		<div class="form-group">
    		<label><?php echo e(__('messages.Phone')); ?></label>
			<input type="text" class="form-control"  name="phone" value="<?php echo e($user->phone); ?>">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="<?php echo e(__('messages.Password')); ?>" name="password">
		</div>

	</div>

	<div class="col-md-4">

		<div class="form-group">
			
			<label><?php echo e(__('messages.Post')); ?></label>
			<?php if( Auth::user()->post=='manager' &&  $user->post != 'manager'): ?>
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
			<?php endif; ?>
			<?php if( Auth::user()->post=='super manager'&& Auth::user()->post!='super manager'): ?>
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
			<?php endif; ?>
			<?php if( Auth::user()->post=='manager' &&  $user->post == 'manager'): ?>
			<select name="post" class="form-control">
			<option value="<?php echo e($user->post); ?>"selected>You Cant Edit Post</Em></option>
			</select>
			<?php endif; ?>
			<?php if( Auth::user()->post!='manager' &&  Auth::user()->post!='super manager'): ?>
			<select name="post" class="form-control">
			<option value="<?php echo e($user->post); ?>"selected>You Cant Edit Post</Em></option>
			</select>
			<?php endif; ?>
			<?php if( Auth::user()->post=='super manager' &&  Auth::user()->post=='super manager'): ?>
			<select name="post" class="form-control">
			<option value="<?php echo e($user->post); ?>"selected>You Cant Edit Post</Em></option>
			</select>
			<?php endif; ?>
			
		</div>

		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="<?php echo e(__('messages.Submit')); ?>">
			<a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
		</div>

	</div>




</form>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>