<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tabulation example</title>

        <style type="text/css">
            dummydeclaration { padding-left: 4em; } /* Firefox ignores first declaration for some reason */
            tab1 { padding-left: 4em; }
            tab2 { padding-left: 8em; }
            tab3 { padding-left: 12em; }
            tab4 { padding-left: 16em; }
            tab5 { padding-left: 20em; }
            tab6 { padding-left: 24em; }
            tab7 { padding-left: 28em; }
            tab8 { padding-left: 32em; }
            tab9 { padding-left: 36em; }
            tab10 { padding-left: 40em; }
            tab11 { padding-left: 44em; }
            tab12 { padding-left: 48em; }
            tab13 { padding-left: 52em; }
            tab14 { padding-left: 56em; }
            tab15 { padding-left: 60em; }
            tab16 { padding-left: 64em; }

        </style>

    </head>

    <body>

<h3><tab9> <?php echo e($print_check->amount); ?> DH</tab9></h3>
<br>
<h3><tab2><?php echo e($print_check->coment); ?></tab2></h3>
<br>
<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
<?php if($print_check->customer_id == $customer->id ): ?>
<h3><tab2><?php echo e($customer->cust_f_name); ?> <?php echo e($customer->cust_l_name); ?> </tab2></h3>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<h3><tab8><?php echo e($print_check->location); ?> &nbsp;&nbsp; <?php echo e(\Carbon\Carbon::parse($print_check->duedate)->format('d/m/Y')); ?></tab8></h3>
<br>

</body>

</html>
