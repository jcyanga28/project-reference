<!DOCTYPE html>
<html lang="en">
  
  <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="PRS,ProjectReferenceSystem,ChartePRS">
		<meta name="description" content="Project Reference Systemn">
		<meta name="author" content="Project Reference System">

		<title>Project Reference System</title>

		<link rel="shortcut icon" href="{{ URL::asset('asset/img/favicon.ico') }}" type="image/x-icon"/>
		<link rel="icon" href="{{ URL::asset('asset/img/favicon.ico') }}" type="image/x-icon"/>

		<!-- css -->
		{{ HTML::style('asset/css/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('asset/css/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('asset/css/frontend-style.css') }}
		{{ HTML::style('asset/css/alert/alert.css') }}

		<!-- script -->
		{{ HTML::script('asset/js/bootstrap/jquery-1.11.1.min.js') }}
		{{ HTML::script('asset/js/bootstrap/js/bootstrap.js') }}

	</head>

		<body>

		<div class="header">
			<div class="container">
				<div class="navbar-header">
					<a href="../" class="navbar-brand" id="projectname">Project Reference System</a>
				</div>
			</div>
		</div>
		<br/>

			<div class="container" id="content-container">

					@yield('content')
				
			</div>

			<footer class="container">

					<div class="footer-content">
						&copy; {{ date('Y') }} Charter Chemical and Coating Corporation 
					</div>
			
			</footer>

		</body>

</html>