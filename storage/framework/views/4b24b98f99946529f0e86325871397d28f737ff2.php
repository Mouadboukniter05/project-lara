<?php $__env->startSection('content'); ?>




<div class="col-md-8">
    <div class="row">
        <div class="col-md-6">
    <div class="panel panel-jc">
        <div class="panel-heading">beneficiary:</div>
        <div class="panel-body">
            <?php echo e($check_view->beneficiary); ?>

        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">Amount:</div>
        <div class="panel-body">
            <?php echo $check_view->amount; ?> DH
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">Location:</div>
        <div class="panel-body">
            <?php echo e($check_view->location); ?>

        </div>
    </div>
    
    </div>
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


    <div class="btn-group">
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'): ?>
        <a href="<?php echo e(route('check.edit', ['id' => $check_view->id ])); ?>" class="btn btn-primary"> edit </a>
        <?php endif; ?>
        <a class="btn btn-default" href="<?php echo e(route('check.show')); ?>">Go Back</a>
    </div>
</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading">Customer</div>
        <div class="panel-body">
            <span class="label label-jc">
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $customer->id == $check_view->customer_id ): ?>
                <a href="<?php echo e(route('check.list', [ 'customerid' => $customer->id ])); ?>"><?php echo e($customer->cust_f_name); ?> <?php echo e($customer->cust_l_name); ?></a>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">User</div>
        <div class="panel-body">
            <span class="label label-jc">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if( $user->id == $check_view->user_id ): ?>
            <?php echo e($user->name); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">Priority</div>
        <div class="panel-body">
            <?php if( $check_view->priority == 0 ): ?>
                <span class="label label-info">Taken</span>
            <?php else: ?>
                <span class="label label-danger">Given</span>
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
            <?php if( $check_view->completed == 0 ): ?>
                <span class="label label-warning">Cash check</span>
                <?php if( $is_overdue ): ?>
                    <span class="label label-danger">Not yet</span>
                <?php else: ?>
                    <p><br><?php echo e($diff_in_days); ?> days left for this check</p>
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