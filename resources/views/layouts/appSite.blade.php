<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon.ico">
        <link rel="icon" type="image/png" href="./assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>BLOG tá ON</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,600,700" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!-- Main CSS -->
        <link href="{{asset('site/css/main.css')}}" rel="stylesheet"/>
</head>


<body>
<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top py-3">
<div class="container">

	<a class="navbar-brand" href="{{route('principal')}}"><strong>BLOG  tá ON</strong></a>
	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-collapse collapse" id="navbarColor02" style="">

		<ul class="navbar-nav mr-auto d-flex align-items-center">
			
        @foreach($categorias as $k => $item)
			<li class="nav-item">
			<a class="nav-link" href="{{route('site.categoria.show',['id'=>$item->id])}}">{{$item->name}}</a>
			</li>
        @endforeach 
		
		</ul>
		
		<form action= "{{route('artigos.buscar')}}" method="get">
		@csrf
		<ul class="navbar-nav mr-auto d-flex align-items-left">		
			<li class="nav-item px-3">
				<input type="text" class="form-control" size="20" id="buscar" name="buscar" placeholder="Digite o conteúdo">
			</li>

			<li class="nav-item px-3">
				<button type="submit" class="btn btn-primary">Buscar</button>
			</li>
		</ul>			
		</form>	
			
		
		
	</div>
</div>
</nav>
<!-- End Navbar -->
    
    
<section>
    @yield('content')
</section>
			
	 
<!--------------------------------------
FOOTER
--------------------------------------->
<div class="container mt-5">
	<footer class="bg-white border-top p-3 text-muted small">
	<div class="row align-items-center justify-content-between">
		<div>
            <span class="navbar-brand mr-2"><strong>BLOG  tá ON</strong></span> Copyright &copy;
			<script>document.write(new Date().getFullYear())</script>
			 . All rights reserved.
		</div>
		<div>
			Made with <a target="_blank" class="text-secondary font-weight-bold" href="https://www.wowthemes.net/mundana-free-html-bootstrap-template/">Mundana Theme</a> by WowThemes.net.
		</div>
	</div>
	</footer>
</div>
<!-- End Footer -->
    
<!--------------------------------------
JAVASCRIPTS
--------------------------------------->
<script src="{{asset('site/js/vendor/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('site/js/vendor/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('site/js/vendor/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('site/js/functions.js')}}" type="text/javascript"></script>

</body>

</html>