@extends('layouts.appSite')

@section('content')

<!--------------------------------------
Main
--------------------------------------->
<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-md-8">
			<h5 class="font-weight-bold spanborder"><span>Featured in {{$ultimo->categoria->name}}</span></h5>
			<div class="card border-0 mb-5 box-shadow">
				<div style="background-image: url({{asset($ultimo->foto)}}); height: 350px; background-size: cover; background-repeat: no-repeat;">
				</div>                          
				<div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
					<h2 class="h2 font-weight-bold">
					<a class="text-dark" href="{{route('site.artigo.show',['slug'=>$ultimo->slug])}}">{{$ultimo->titulo}}</a>
					</h2>
					<p class="card-text">
						 {{$ultimo->resumo}}
					</p>
					<div>
						<small class="d-block"><a class="text-muted" href="./author.html">{{$ultimo->autor->name}}</a></small>
						<small class="text-muted">{{$ultimo->data_postagem}} post</small>
					</div>
				</div>
			</div>
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
						<small class="text-muted">{{$item->data_postagem}} post</small>
					</div>
					<img height="120" width="180" class="mb-3"src="{{asset($item->foto)}}">
				</div>
		@endforeach
			
		</div>
		<div class="col-md-4 pl-4">
			<div class="sticky-top">
				<h5 class="font-weight-bold spanborder"><span>Populares</span></h5>
				<ol class="list-featured">
				@foreach($populares as $k => $item)
						<li>
						<span>
						<h6 class="font-weight-bold">
						<a href="{{route('site.artigo.show',['slug'=>$item->slug])}}" class="text-dark">{{$item->titulo}}</a>
						</h6>
						<p class="text-muted">
							{{$item->autor->name}}
						</p>
						</span>
						</li>
				@endforeach
				</ol>
			</div>
		</div>
	</div>
</div>
    
<div class="container pt-4 pb-4">
	<div class="border p-5 bg-lightblue">
		<div class="row justify-content-between">
			<div class="col-md-6">
				<h5 class="font-weight-bold secondfont">Seja um Membro</h5>
				Receba as últimas notícias diretamente na sua caixa de entrada. É gratuito e você pode cancelar a assinatura a qualquer momento. Odiamos spam tanto quanto nós, por isso nunca enviamos spam!
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="First name">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="Last name">
					</div>
					<div class="col-md-12 mt-3">
						<button type="submit" class="btn btn-success btn-block">Inscrever-se</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Main -->	
			
						
					


@endsection	

	<!-- End Main -->
		
