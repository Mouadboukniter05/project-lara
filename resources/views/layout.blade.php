<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/ico.ico') }}" />

        <title>PROJECT-FM</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- Fonts -->

        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        @yield('styles')

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
                            <a href="{{ route('user.index') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ __('messages.USERS') }}</a>
                        </li>

                                                            

                        


                        {{-- <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Project <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('projet.show') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> All Projects</a></li>
                                @if ( Auth::user()->post=='manager' ||Auth::user()->post=='super manager')
                                <li><a href="{{ route('projet.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Project</a></li>
                                @endif
                            </ul>
                        </li> --}}
                        @if ( Auth::user()->post!='multimedia')
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> {{ __('messages.Check') }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('check.show') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{ __('messages.Given') }}</a></li>
                                <li><a href="{{ route('check.show_2') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{ __('messages.Taken') }}</a></li>
                                @if ( Auth::user()->post=='manager'|| Auth::user()->post=='operation'||Auth::user()->post=='super manager')
                                <li><a href="{{ route('check.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ __('messages.crate_check') }}</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        {{-- <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{ __('messages.Report') }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('report.show') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{ __('messages.All_Report') }}</a></li>
                                <li><a href="{{ route('report.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ __('messages.Create_report') }}</a></li>
                            </ul>
                        </li> --}}
                        @if ( Auth::user()->post!='multimedia')
                        <li>
                            <a href="{{ route('customer.show') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ __('messages.Customers') }}</a>
                        </li>
                        @endif
                       
                        {{-- <li>
                            <a href="{{ route('boit_message.show') }}"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {{ __('messages.messages_box') }}</a>
                        </li> --}}
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>  {{ __('messages.messages_box') }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('boit_message.show') }}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> {{ __('messages.Messages_in') }}</a></li>
                                <li><a href="{{ route('boit_message_in.show') }}"><span class="	glyphicon glyphicon-send" aria-hidden="true"></span> {{ __('messages.Messages_out') }}</a></li>
                                <li>
                                    <a href="{{ route('message.show') }}"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> {{ __('messages.Messages') }}</a>
                                </li>
                            </ul>
                        </li>
                        @if ( Auth::user()->post=='manager'|| Auth::user()->post=='multimedia' ||Auth::user()->post=='super manager')
                        <li>
                            <a href="{{ route('contact.show') }}"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> {{ __('messages.Contacts') }}</a>
                        </li>
                        @endif
                        {{-- <li>
                            <a href="{{ route('PDF.Print') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> PDF</a>
                        </li> --}}
                        {{-- <li><a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a></li>

                        <li><a href="{{ url('locale/fr') }}" ><i class="fa fa-language"></i> FR</a></li> --}}


                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">{{ __('messages.Login') }} </a></li>
                            
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    
                                    <li><a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> EN</a> 
                                        <a href="{{ url('locale/fr') }}" ><i class="fa fa-language"></i><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> FR</a></li>

                                     {{-- <li><a href="{{ url('locale/fr') }}" ><i class="fa fa-language"></i> FR</a></li> --}}
                                     <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            {{ __('messages.Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                
                            </li>
                        @endif
                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        <section class="main-content">
        <div class="container">   
           
                @yield('content')
            
        </div>
        </section>

        <!--   FOOTER -->
       
        

    </body>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>    

<script src="{{asset('js/toastr.min.js') }}"></script>

<script src="{{ asset('js/sweetalert2.min.js') }}"></script>

<script>

@if ( Session::has('success') )
    toastr.success("{{ Session::get('success') }}")
@endif

@if ( Session::has('info') )
    toastr.info("{{ Session::get('info') }}")
@endif


@if ( Session::has('error') )
    toastr.error("{{ Session::get('error') }}")
@endif

</script>

@yield('scripts')


</html>