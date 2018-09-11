<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Weather Forecasting Web App</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css">
		<link href="{{ asset('fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		
		<!--[if lt IE 9]>
		<script src="{{ asset('js/weather/ie-support/html5.js') }}"></script>
		<script src="{{ asset('js/weather/ie-support/respond.js') }}"></script>
		<![endif]-->

	</head>
	<body>
		<div class="site-content">
			<div class="site-header">
				<div class="container">
					<a href="{{url('/')}}" class="branding">
						<img src="{{ asset('images/logo.png') }}" alt="" class="logo">
						<div class="logo-type">
							<h1 class="site-title">Weather Forecast</h1>
						</div>
					</a>

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item {{ $current == 'home'? 'current-menu-item':'' }}"><a href="{{url('/')}}">Home</a></li>
							<li class="menu-item {{ $current == 'dashboard'? 'current-menu-item':'' }}"><a href="{{url('/dashboard')}}">Dashboard</a></li>
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>
				</div>
			</div> <!-- .site-header -->
			@section('page')
			@show
			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
                            <p>Find me on:</p>
                            <div class="social-links">
								<a href="https://www.linkedin.com/in/agungberliantara/"><i class="fa fa-linkedin"></i></a>
								<a href="https://twitter.com/agungyudha_b"><i class="fa fa-twitter"></i></a>
								<a href="https://github.com/yudha-ab"><i class="fa fa-github"></i></a>
							</div>
                        </div>
                        <div class="col-md-4">
                            <p class="colophon">Designed by Themezy. All rights reserved</p>
                        </div>
					</div>
				</div>
			</footer> <!-- .site-footer -->
		</div>
		
		<script src="{{ asset('js/weather/jquery-1.11.1.min.js') }}"></script>
		<script src="{{ asset('js/weather/plugins.js') }}"></script>
		<script src="{{ asset('js/weather/app.js') }}"></script>
		
	</body>

</html>