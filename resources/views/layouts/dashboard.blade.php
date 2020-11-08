<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SALE</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">

  	<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">

		<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

</head>
<body>
<?php
    $segment = Request::segment(1);
?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{asset('img/sidebar-4.jpg')}}">

    <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
				<div class="logo">
                <a href="#" class="simple-text">
                    <img src="{{asset('/uploads/images/fw.png')}}" style="width: 200px;"alt="">
                </a>
            </div>

            <ul class="nav">
                <li class=" @if(!$segment) active @endif">
                    <a href="{{route('accueil.index')}}">
                        <i class="pe-7s-home"></i>
                        <p>ACCUEIL</p>
                    </a>
                </li> 

                <li class=" @if($segment == 'depense') active @endif">
                    <a href="{{ route('depense.index')}}">
                            <i class="pe-7s-angle-up-circle"></i>
                            <p>DEPENSES</p>
                    </a>
                </li>

                    <li class=" @if($segment == 'entrees') active @endif">
                        <a href="{{ route('entrees.index')}}">
                                <i class="pe-7s-angle-down-circle"></i>
                                <p>ENTREES</p>
                        </a>
                    </li>
                    <li class=" @if($segment == 'stock') active @endif">
                        <a href="{{ route('stock.index')}}">
                                <i class="pe-7s-box2"></i>
                                <p>STOCk</p>
                        </a>
                    </li>

                <li class=" @if($segment == 'vente') active @endif">
                    <a href="{{route('vente.index')}}">
                        <i class="pe-7s-cart"></i>
                        <p>VENTES</p>
                    </a>
                </li>


                <li class=" @if($segment == 'crediter') active @endif">
                        <a href="{{route('crediter.index')}}">
                                <i class="pe-7s-user"></i>
                                <p>CREDITS</p>
                        </a>
                </li>

                <li class=" @if($segment == 'total') active @endif">
                        <a href="{{route('total.index')}}">
                                <i class="pe-7s-cash"></i>
                                <p>TOTAUX</p>
                        </a>
                </li>

                <li class=" @if($segment == 'fournisseur') active @endif">
                    <a href="{{ route('fournisseur.index')}}">
                            <i class="pe-7s-users"></i>
                            <p>FOURNISSEURS</p>
                    </a>
                </li>

				@if(Auth::user()->niveau == 1)
	                <li class=" @if($segment == 'utilisateur') active @endif">
	                    <a href="{{ route('utilisateur.index')}}">
	                        <i class="pe-7s-users"></i>
	                        <p>UTILISATEURS</p>
	                    </a>
	                </li>
				@endif

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home')}}"><i style="font-size: 35px;" class="pe-7s-left-arrow"></i></a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                    <i class="pe-7s-user"></i>
                                    {{ Auth::user()->prenom . ' ' .  Auth::user()->nom }}
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ route('profil.index')}}">Voir mon profil</a></li>
                                <li><a href="{{ route('utilisateur.edit', Auth::user()->id)}}">Modifier mon profil</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Se deconnecter ') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </li>
                              </ul>
                        </li>
                        <li>

                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

          @yield('content')

        <footer class="footer">
            <div class="container-fluid">
             <!--
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                -->
                <p class="copyright text-center">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">FAYE ET FRERE APPLI</a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
  <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('js/bootstrap-notify.js')}}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{asset('js/demo.js')}}"></script>


    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <script type="text/javascript">
         @if(Session::has('success'))
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-angle-down-circle',
                    message: "{{Session::get('success')}}"

                },{
                    type: 'success',
                    timer: 4000
                });

            });
        @endif

        @if(Session::has('info'))
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-info',
                    message: "{{Session::get('info')}}"

                },{
                    type: 'info',
                    timer: 4000
                });

            });
        @endif

	</script>
</html>
