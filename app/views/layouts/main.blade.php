<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		@if (!$__env->yieldContent('titulo'))
			<title>Proyecto Facturación</title>
		@else
			@yield('titulo')
		@endif

		{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('css/main.css')}}
	</head>
 	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					@yield('navbar')
				</div>
			</div>
		</div>
		
		<div class="row">
			@yield('navlateral')

			<div class="span12">
				<div class="row">
					@if(Session::has('message'))
						<p class="alert">{{ Session::get('message') }}</p>
					@endif
					@yield('content')
				</div>
			</div>
		</div>
	</body>
</html>