<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
        <title>Projet de fin d'étude</title>
<!--

App Landing Template

http://www.templatemo.com/tm-474-app-landing

-->
        <!-- CSS -->
        <link rel="stylesheet" href="home/css/bootstrap.min.css">
        <link rel="stylesheet" href="home/css/font-awesome.min.css">
        <link rel="stylesheet" href="home/css/templatemo_style.css">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="favicon.png" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Top menu -->
        <div class="show-menu">
            <a href="#" class="shadow-top-down">+</a>
        </div>
        <nav class="main-menu shadow-top-down">
            <ul class="nav nav-pills nav-stacked">
                <li>
                        <a href="{{ url('/login') }}">Login</a>
                 
                </li>
                <li><a href="#templatemo_home" class="scroll_effect">Home</a></li>
                <li><a href="#templatemo_features" class="scroll_effect">Features</a></li>
                <li><a href="#templatemo_download" class="scroll_effect">Project</a></li>
                <li><a href="#templatemo_contact" class="scroll_effect">Contact</a></li>
            </ul>
        </nav>
        <!-- Home -->
        <section id="templatemo_home">
            <div class="container">
                <div class="templatemo_home_inner_wapper">
                    <h1 class="text-center">Project-FM</h1>
                </div>
                <div class="templatemo_home_inner_wapper">
                    <h2 class="text-center">Your App Name</h2>
                    <p class="text-center">
                        This is an app landing page from 
                        Project Online is a powerful online solution for Project Portfolio Management (PPM) and everyday work. Delivered through Office 365, Project Online enables organizations to get started, prioritize project portfolio investments and deliver the intended business value—from virtually anywhere on nearly any device.  </p>
                </div>
                <div class="templatemo_home_inner_wapper btn_wapper">
                    <div class="col-sm-6">
                        <a href="#templatemo_features" class="btn col-xs-12 scroll_effect shadow-top-down">
                            Features
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="#templatemo_download" class="btn col-xs-12 scroll_effect shadow-top-down">
                            
                            Projects
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features -->
        <section id="templatemo_features">
            <div class="container-fluid">
                <header class="template_header">
                    <h1 class="text-center"><span>...</span> Features <span>...</span></h1>
                </header>
                <div class="col-sm-12">
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-music"></i>
                            </div>
                            <p>
                                Strategy Execution Management
Strategy Execution Management
Strategy Execution Management is focused on supporting the dynamic portfolio management needs of business strategists, steering committees, strategy realization offices (SROs) and enterprise portfolio .</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-pagelines"></i>
                            </div>
                            <p>
                                Obtain global visibility across both Agile and Traditional projects from your Project Online environment by connecting your agile tools for better decision making, cost tracking, strategic alignment and resource planning. Give NPD the tools they need for competitive advantagefor project success. </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-ship"></i>
                            </div>
                            <p>
                                Product teams must be innovative, agile and effective at deploying the right resources to the right work at the right time. Knowing when to bring a product to market can mean the difference between a leader and 2nd place. Give NPD the tools they need for competitive advantage. </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <p>
                                Due to the ongoing shifts in the economy, discretionary spending has been reduced and the constant need to justify business decisions has forced business leaders to tighten controls. The perfect combination of value optimization and resource utilization has become essential for project success.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Download -->
        <section id="templatemo_download">
            <div class="container">
                <header class="template_header">
                    <h1 class="text-center"> Our Project </h1>
                </header>
                <div class="templatemo_download_text_wapper">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                </div>
                <div class="col-xs-12">
                    <h2>50,500</h2>
                </div>
                <div class="col-xs-12">
                    <p>Over 50K new project</p>
                </div>
                
            </div>
            
        </section>
        <!-- Contact -->
        <section id="templatemo_contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <header class="template_header">
                            <h1 class="text-center"><span>...</span> Contact <span>...</span></h1>
                        </header>
                        <p class="text-center">
                            <i class="fa fa-map-marker"></i> 8080 CASABLANCA<br />
                            <i class="fa fa-envelope"></i> Email: <a href="mailto:info@company.com">email@company.com</a><br />
                            <i class="fa fa-phone"></i> Phone: <a href="tel:010-020-0340">010-020-03-40</a>
                        </p>
                    </div>
                </div>
            <form role="form" action="{{route('contact.store')}}" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-at"></i></div>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            <textarea name="message" class="form-control" id="message" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-xs-offset-6">
                            <button type="submit" class="form-control">Send</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-pills social">
                            <li><a href="#" class="shadow-top-down social-facebook"><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="#" class="shadow-top-down social-twitter"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="#" class="shadow-top-down social-youtube"><i class="fa fa-youtube-square"></i></a></li>
                            <li><a href="#" class="shadow-top-down social-instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        {{--  --}}
        <!-- require plugins -->
        <script src="home/js/jquery.min.js"></script>
        <script src="home/js/jquery-ui.min.js"></script>
        <script src="home/js/bootstrap.min.js"></script>
        <script src="home/js/jquery.parallax.js"></script>
        <!-- template mo config script -->
        <script src="home/js/templatemo_scripts.js"></script>
    </body>
</html>