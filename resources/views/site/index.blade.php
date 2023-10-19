@extends('layouts.appSite')

@section('content')
 
	<div class="container">
		<div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
			<div class="pl-4 pr-0 h-100 tofront">
				<div class="row justify-content-between">
					<div class="col-md-6 pt-6 pb-6 align-self-center">
						<h1 class="secondfont mb-3 font-weight-bold">{{$ultimo->titulo}}</h1>
						<p class="mb-3">
						{{$ultimo->resumo}}
						</p>
						<a href="{{route('site.artigo.show',['slug'=>$ultimo->slug])}}" class="btn btn-dark">Leia mais</a>
					</div>
					<div class="col-md-6 d-none d-md-block pr-0" style="background-size:cover;background-image:url({{asset($ultimo->foto)}});">	</div>
				</div>																								
			</div>
		</div>
	</div>

    
<!--------------------------------------
MAIN
--------------------------------------->
    
	<div class="container pt-4 pb-4">
		<div class="row">
			<div class="col-lg-6">
				<div class="card border-0 mb-4 box-shadow h-xl-300">
				        
					<div style="background-image: url({{asset($penultimo->foto)}}); height: 150px;    background-size: cover;    background-repeat: no-repeat;"></div>               
					<div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
						<h2 class="h4 font-weight-bold">
						<a class="text-dark" href="{{route('site.artigo.show',['slug'=>$penultimo->slug])}}">{{$penultimo->titulo}}</a>
						</h2>
						<p class="card-text">
						    {{$penultimo->resumo}}
						</p>
						<div>
							<small class="d-block"><a class="text-muted" href="#">{{$penultimo->autor->name}}</a></small>
							<small class="text-muted">{{$penultimo->data_postagem}} &middot; post</small>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="flex-md-row mb-4 box-shadow h-xl-300">

				@foreach($aleatorio as $k => $item)
					<div class="mb-3 d-flex align-items-center">
						<img height="80" width="140" src="{{asset($item->foto)}}">
						<div class="pl-3">
							<h2 class="mb-2 h6 font-weight-bold">
							<a class="text-dark" href="{{route('site.artigo.show',['slug'=>$item->slug])}}">{{$item->titulo}}</a>
							</h2>
							<div class="card-text text-muted small">
							{{$item->autor->name}} in {{$item->categoria->name}}
							</div>
							<small class="text-muted">{{$item->data_postagem}} &middot; post</small>
						</div>
					</div>
				@endforeach	
			
				</div>
			</div>
		</div>
	</div>
    
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-md-8">
				<h5 class="font-weight-bold spanborder"><span>Recentes</span></h5>

			@foreach($recentes as $k => $item)
				<div class="mb-3 d-flex justify-content-between">
					<div class="pr-3">
						<h2 class="mb-1 h4 font-weight-bold">
						<a class="text-dark" href="{{route('site.artigo.show',['slug'=>$item->slug])}}">{{$item->titulo}}</a>
						</h2>
						<p>
						{{$item->resumo}}
						</p>
						<div class="card-text text-muted small">
						{{$item->autor->name}} in {{$item->categoria->name}}
						</div>
						<small class="text-muted">{{$item->data_postagem}} &middot; post</small>
					</div>
					<img height="120" width="180" class="mb-3" src="{{asset($item->foto)}}">
				</div>
			@endforeach

			</div>

			<div class="col-md-4 pl-4">
				<h5 class="font-weight-bold spanborder"><span>Populares</span></h5>
				<ol class="list-featured">

                @foreach($populares as $k => $item)
					<li>
					<span>
					<h6 class="font-weight-bold">
					<a href="{{route('site.artigo.show',['slug'=>$item->slug])}}" class="text-dark">{{$item->titulo}}</a>
					</h6>
					<p class="text-muted">
						{{$item->autor->name}} in {{$item->categoria->name}}
					</p>
					</span>
					</li>
				@endforeach
					
				</ol>
			</div>
		</div>
	</div>

@endsection
	

    
<!--------------------------------------
JAVASCRIPTS
--------------------------------------->

