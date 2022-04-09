<?php $__env->startSection('content'); ?>




<div class="col-md-8">
    <div class="row">
        <div class="col-md-6">
    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Beneficiary')); ?>:</div>
        <div class="panel-body">
            <?php echo e($check_view->bank); ?>

        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Amount')); ?>:</div>
        <div class="panel-body">
            <?php echo $check_view->amount; ?> DH
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Location')); ?>:</div>
        <div class="panel-body">
            <?php echo e($check_view->location); ?>

        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.observation')); ?>:</div>
        <div class="panel-body">
            <?php echo e($check_view->observation); ?>

        </div>
    </div>
    
    </div>
</div>

    <div class="row">
        <hr>
        <?php if( count($images_set) > 0 ): ?> 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading"><?php echo e(__('messages.U_Images')); ?></div>
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
                    <div class="panel-heading"><?php echo e(__('messages.U_Files')); ?></div>
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
        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager'): ?>
        <a href="<?php echo e(route('check.edit', ['id' => $check_view->id ])); ?>" class="btn btn-primary"><?php echo e(__('messages.edit')); ?> </a>
        <?php endif; ?>
        <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
    </div>
</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Customer')); ?></div>
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
        <div class="panel-heading"><?php echo e(__('messages.user')); ?></div>
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
        <div class="panel-heading"><?php echo e(__('messages.Priority')); ?></div>
        <div class="panel-body">
            <?php if( $check_view->priority == 0 ): ?>
                <span class="label label-info"><?php echo e(__('messages.Taken')); ?></span>
            <?php else: ?>
                <span class="label label-danger"><?php echo e(__('messages.Given')); ?></span>
            <?php endif; ?>
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Created_At')); ?></div>
        <div class="panel-body">
            <?php echo e($formatted_from); ?> 
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Due_Date')); ?></div>
        <div class="panel-body">
            <?php echo e($formatted_to); ?> 
        </div>
    </div>


    <div class="panel panel-jc">
        <div class="panel-heading"><?php echo e(__('messages.Status')); ?></div>
        <div class="panel-body">
            <?php if( $check_view->completed== 0 ): ?>
               
                <span class="label label-danger">Impayé</span>
                <span class="label label-danger"><?php echo e(( $check_view->duedate < Carbon\Carbon::now() )  ? "!" : ""); ?></span>
            <?php endif; ?>
            <?php if($check_view->completed==1): ?>
                <span class="label label-success">Payer</span>
            <?php endif; ?>
            <?php if($check_view->completed==2): ?>
                <span class="label label-warning"> Échanger contre espèce</span>
            <?php endif; ?>
            <?php if($check_view->completed==3): ?>
                <span class="label label-primary">Annulé</span>
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