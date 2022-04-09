<!DOCTYPE html>
<html>
<head>
	<title>title</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>" type="image/x-icon">

	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/fonts.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.12/vue.js"></script>
	<script src="<?php echo e(asset('assets/js/ui.js')); ?>"></script>
</head>
<body>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  
		ga('create', '<?php echo getenv('GOOGLE_UA'); ?>', 'auto');
		ga('send', 'pageview');
	  
	  </script>
<script>
	window.baseurl = ''
</script>

<div id="sheet" class="animated"></div>
<div id="pop-up-prompt" class="animated">
	<header><h3 class="color-badge"></h3></header>
	<div>
		<p></p>
        <section>
            <span id="cancel-btn" class="btn"></span>
            <span id="confirm-btn" class="btn"></span>
        </section>
	</div>
</div>

<div class="home-container">
	<div class="hug hug-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="" class="pull-left"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Ribbbon"></a>
                    <a href="" class="btn btn-primary btn-line pull-right login">Login</a>
                    <a href="" class="btn btn-primary btn-line pull-right register">Register</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
	</div>

    
    <div class="hug hug-hero">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="left-side">
                        <h1>Introducing Ribbbon 2.0</h1>
                        <h2>An open source project management system.</h2>
                        <a href="" class="btn btn-special">GET STARTED</a>
                    </div>
                    <div class="right-side">
                        <img class="mascot" src="<?php echo e(asset('assets/img/mascot_left.png')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="hug hug-skyline">
        <div class="skyline"></div>
    </div>

    
    <div class="hug hug-features">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-center">Ribbbon comes full of delightful features!</h2>
                </div>
                <div class="col-xs-12 col-md-3 feature">
                    <i class="ion-ios-person-outline"></i>
                    <h3>clients</h3>
                    <p>Manage unlimited amount of clients. Add additional information for each client
                        such as, contact person, email, and phone number.</p>
                </div>
                <div class="col-xs-12 col-md-3 feature">
                    <i class="ion-ios-box-outline"></i>
                    <h3>projects</h3>
                    <p>Create projects that are connected to clients. Projects are displayed
                        in an agile format and have special sections to store project based
                        credentials.</p>
                </div>
                <div class="col-xs-12 col-md-3 feature">
                    <i class="ion-ios-checkmark-outline"></i>
                    <h3>tasks</h3>
                    <p>Create an unlimited amount of tasks for any project. Push them across
                        the scrum board and assign weights and priority per task.</p>
                </div>
                <div class="col-xs-12 col-md-3 feature">
                    <i class="ion-ios-gear-outline"></i>
                    <h3>weights</h3>
                    <p>Each task has a weight number, the bigger the weight the harder the task
                        is to complete. This allows you to keep track on how big a project really is. Pretty handy stuff.</p>
                </div>
                <div>
                    <div class="col-xs-12 col-md-3 feature centered">
                        <i class="ion-ios-people-outline"></i>
                        <h3>project sharing <span class="new">new!</span></h3>
                        <p>Share your projects with multiples users and collaborate together on your projects.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="hug hug-info text-center">
        <img class="arrow" src="<?php echo e(asset('assets/img/arrows.png')); ?>" alt="Arrows">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>We Are Powered by</h2>
                    <h3>Laravel & Vue.js</h3>

                    <img src="<?php echo e(asset('assets/img/laravel.png')); ?>" alt="Laravel">
                    <img src="<?php echo e(asset('assets/img/vue.png')); ?>" alt="Vue.js">
                </div>
            </div>
        </div>
    </div>

    
    <div class="hug hug-ui text-center">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-bucket">
                        <h2>Did we mention it looks good too?</h2>
                        <h3>Less fuzz while still having all the info you need at a glance.</h3>
                    </div>
                    <img src="<?php echo e(asset('assets/img/project_screenshot.png')); ?>" alt="Project Page">
                </div>
            </div>
        </div>
    </div>

    
    <div class="hug hug-exit">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="img">
                        <h2>"Free, sexy, and open source. I think it's time for you to take the dive."</h2>
                        <a href="" class="btn btn-special">GET STARTED</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="hug hug-footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Current Version <span class="color-primary">2.2</span> | <a class="color-primary" href="https://github.com/canvasowl/ribbbon" target="_blank">Go To Project</a></h3>
                    <hr class="special">
                    <p class="text-center last-line">Copyright <?php echo e(date("Y")); ?> &copy;  <a href="https://twitter.com/canvasowl" target="_blank">Jefry Cruz</a></p>
                </div>
            </div>
        </div>
    </div>
</div>