@extends('layouts.appSite')

@section('content')

<!--------------------------------------
Main
--------------------------------------->
<div class="container px-5 mt-5 mb-5">
	<div class="row">
		<div class="col-md-11 mx-3">
			
			<h5 class="font-weight-bold spanborder"><span>Encontrados</span></h5>

			@foreach($artigos as $k => $item)
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
		
