<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Projet de fin d'étude</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <!-- Fonts -->

        <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert2.min.css')); ?>" />

        <link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">

        <?php echo $__env->yieldContent('styles'); ?>

    </head>
    <body>
        <!-- /resources/views/layout.blade.php -->
        
        <nav id="myNavbar" class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">PROJECT-FM</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <!-- <li><a href="#">Home</a></li>  --> 

                        <li>
                            <a href="<?php echo e(route('user.index')); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
                        </li>

                                                            

                        


                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Project <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(route('projet.show')); ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> All Projects</a></li>
                                <?php if( Auth::user()->post=='manager' ): ?>
                                <li><a href="<?php echo e(route('projet.create')); ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Project</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if( Auth::user()->post!='multimedia'): ?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Check <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(route('check.show')); ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> All Checks</a></li>
                                <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='operation'): ?>
                                <li><a href="<?php echo e(route('check.create')); ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Check</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Report <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(route('report.show')); ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> All Report</a></li>
                                <li><a href="<?php echo e(route('report.create')); ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new report</a></li>
                            </ul>
                        </li>
                        <?php if( Auth::user()->post!='multimedia'): ?>
                        <li>
                            <a href="<?php echo e(route('customer.show')); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Customer</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('message.show')); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Message</a>
                        </li>
                        <?php if( Auth::user()->post=='manager'|| Auth::user()->post=='multimedia'): ?>
                        <li>
                            <a href="<?php echo e(route('contact.show')); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Contacts</a>
                        </li>
                        <?php endif; ?>
                        
                        


                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        <section class="main-content">
        <div class="container">   
           
                <?php echo $__env->yieldContent('content'); ?>
            
        </div>
        </section>

        <!--   FOOTER -->
       
        

    </body>

<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>    

<script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/sweetalert2.min.js')); ?>"></script>

<script>

<?php if( Session::has('success') ): ?>
    toastr.success("<?php echo e(Session::get('success')); ?>")
<?php endif; ?>

<?php if( Session::has('info') ): ?>
    toastr.info("<?php echo e(Session::get('info')); ?>")
<?php endif; ?>


<?php if( Session::has('error') ): ?>
    toastr.error("<?php echo e(Session::get('error')); ?>")
<?php endif; ?>

</script>

<?php echo $__env->yieldContent('scripts'); ?>


</html>