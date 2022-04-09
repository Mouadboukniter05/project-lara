<?php $__env->startSection('content'); ?>




<div class="col-md-8">
    <h1><?php echo e($projet_view->projet_title); ?></h1>

    <div class="form-group">
        <label>Description:</label>
        <p><?php echo $projet_view->projet; ?></p>
    </div>
        

    <div class="btn-group">
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
        <a href="<?php echo e(route('projet.edit', ['id' => $projet_view->id ])); ?>" class="btn btn-primary"> edit </a>
        <?php endif; ?>
        <a class="btn btn-default" href="<?php echo e(route('projet.show')); ?>">Go Back</a>
    </div>

    <div class="row">
        <hr>
        <?php if( count($images_set) > 0 ): ?> 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">Uploaded Images</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            <?php $__currentLoopData = $images_set; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li> 
                                    <a href="<?php echo asset("images/$image") ?>" data-lightbox="images-set">
                                        <img class="img-responsive" src="<?php echo asset("images/$image") ?>">
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            </div>
        <?php endif; ?>


        
        <?php if( count($files_set) > 0 ): ?> 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading"> Uploaded Files</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            <?php $__currentLoopData = $files_set; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li> 
                                    <a target="_blank" href="<?php echo asset("images/$file") ; ?>"><?php echo e($file); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            </div>
        <?php endif; ?>


    </div>



</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading">Customer</div>
        <div class="panel-body">
            <span class="label label-jc">
                <a href="<?php echo e(route('projet.list', [ 'customerid' => $projet_view->customer->id ])); ?>"><?php echo e($projet_view->customer->cust_f_name); ?> <?php echo e($projet_view->customer->cust_l_name); ?></a>
            </span>
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">Priority</div>
        <div class="panel-body">
            <?php if( $projet_view->priority == 0 ): ?>
                <span class="label label-info">Normal</span>
            <?php else: ?>
                <span class="label label-danger">High</span>
            <?php endif; ?>
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading">Created</div>
        <div class="panel-body">
            <?php echo e($formatted_from); ?> 
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">Due Date</div>
        <div class="panel-body">
            <?php echo e($formatted_to); ?> 
        </div>
    </div>


    <div class="panel panel-jc">
        <div class="panel-heading">Status</div>
        <div class="panel-body">
            <?php if( $projet_view->completed == 0 ): ?>
                <span class="label label-warning">Open</span>
                <?php if( $is_overdue ): ?>
                    <span class="label label-danger">Overdue</span>
                <?php else: ?>
                    <p><br><?php echo e($diff_in_days); ?> days left to complete this projet</p>
                <?php endif; ?>                
            <?php else: ?>
                <span class="label label-success">Closed</span>
            <?php endif; ?>
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