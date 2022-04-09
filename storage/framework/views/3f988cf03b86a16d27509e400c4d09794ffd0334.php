<?php $__env->startSection('content'); ?>




<div class="col-md-8">
    <h1><?php echo e($report_view->raport_title); ?></h1>

    <div class="form-group">
        <label><?php echo e(__('messages.Report')); ?>:</label>
        <p><?php echo $report_view->raport; ?></p>
    </div>
        

    <div class="btn-group">
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager'): ?>
        <a href="<?php echo e(route('report.edit', ['id' => $report_view->id ])); ?>" class="btn btn-primary"><?php echo e(__('messages.edit')); ?></a>
        <?php endif; ?>
        <a class="btn btn-default" href="<?php echo e(route('report.show')); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
    </div>

  
</div>

<div class="col-md-4">



    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.user')); ?></div>
        <div class="panel-body">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $report_view->user_id ): ?>
                <span class="label label-info"> <?php echo e($user->name); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Created_At')); ?></div>
        <div class="panel-body">
            <?php echo e($report_view->created_at); ?>

        </div>
    </div>


</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/lightbox.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/lightbox.min.js')); ?>"></script>  

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>