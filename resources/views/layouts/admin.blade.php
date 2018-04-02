<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('storage/logos/healthy-logo2.svg')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div class="dash-root app">
		<div class="container-fluid">
			<div class="row">
				<div class="dash-top-line"></div>
			</div>
			<div class="wrapper">
				<div id="dash-sidebar" class="p-0">
						@include('components.sidenav')
				</div>

				<div id="dash-content" class="p-0">
					<nav class="navbar navbar-light dash-nav py-3 bg-light">
						<div id="sidenavcollapse"><span class="navbar-toggler-icon"></span></div>
						<ul class="nav justify-content-end">
							<li class="nav-item dropdown"><a class="nav-link" data-toggle="dropdown"><i class="fa fa-bell" ></i></a>
								<div class="dropdown-menu" style="right:0; left:auto;">
									<div class="dropdown-item pt-3">
										<a>
											Notification One
										</a>
									</div>
									<div class="dropdown-item pt-3">
										<a>
											Notification two
										</a>
									</div>
									<div class="dropdown-item pt-3">
										<a>
											Notification three
										</a>
									</div>
								</div>

							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{{Auth::user()->name}}
									<i class="fa fa-cog ml-2"></i>
								</a>
								<div class="dropdown-menu" style="right:0; left:auto;">
									<a class="dropdown-item" href="#">
								    	<i class="fa fa-bell-o mr-1" aria-hidden="true"></i>
								    	Notifications
								    </a>
								    <a class="dropdown-item" href="#">
								    	<i class="fa fa-user-md mr-1" aria-hidden="true"></i>
								    	Update Profile
								    </a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="#">
								    	<i class="fa fa-bell-o mr-1" aria-hidden="true"></i>
								    	Notifications
								    </a>
								    <a class="dropdown-item" href="#">
								    	<i class="fa fa-user-md mr-1" aria-hidden="true"></i>
								    	Update Profile
								    </a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								    	<i class="fa fa-sign-out mr-1" aria-hidden="true"></i>Lgout
								    </a>
								    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
								</div>
							</li>
						</ul>
					</nav>

					<div class="dashboard-content p-3">
						@yield('content')
					</div>
					<footer class="footer">
				          <div class="bottom-footer py-3 pl-3">
				            &copy Oval UI 2018
				          </div>
				    </footer>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/myajax.js') }}"></script>
    <script type="text/javascript">
    	
    	$(document).ready(function(){
             $('#sidenavcollapse').click(function(){
             	$('#dash-sidebar').toggleClass('wazi');
             	$('#dash-content').toggleClass('wazi');
             });
    	});
    </script>
</body>
</html>