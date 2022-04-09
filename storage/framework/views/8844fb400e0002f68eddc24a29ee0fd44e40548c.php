<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<form id="project_form" action="<?php echo e(route('project.update', [ 'id' => $edit_project->id ])); ?>" method="POST">
    <?php echo e(csrf_field()); ?>


<label>Edit Project <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></label>

<div class="row">
    <div class="col-md-8">
		<div class="form-group">
			<input type="text" class="form-control" id="project" name="name" value="<?php echo e($edit_project->project_name); ?>">
		</div>
	</div>


	<div class="col-md-4">
		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
			<a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Cancel</a>
		</div>
	</div>
</div>

</form>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>