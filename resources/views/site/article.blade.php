@extends('layouts.appSite')

@section('content')


<div class="container">
	<div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
		<div class="h-100 tofront">
			<div class="row justify-content-between">
				<div class="col-md-6 pt-4 pb-6 pr-6 align-self-center">
					<p class="text-uppercase font-weight-bold">
						<a class="text-danger" href="{{route('site.categoria.show',['id'=>$artigo->categoria->id])}}">{{$artigo->categoria->name}}</a>
					</p>
					<h1 class="display-4 secondfont mb-3 font-weight-bold">{{$artigo->titulo}}</h1>
					<p class="mb-3">
						{{$artigo->resumo}}
					</p>
					<div class="d-flex align-items-center">
						<img class="rounded-circle" src="{{asset($artigo->autor->foto)}}" width="70">
						<small class="ml-2">{{$artigo->autor->name}} <span class="text-muted d-block">{{$artigo->data_postagem}} &middot;</span>
						</small>
					</div>
				</div>
				<div class="col-md-6 pr-0 pt-6">
					<img src="{{asset($artigo->foto)}}">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->
    
<!--------------------------------------
MAIN
--------------------------------------->
<div class="container pt-1 pb-4">
	<div class="row justify-content-center">
		<div class="col-lg-2 pr-4 mb-4 col-md-12">
			<div class="sticky-top text-center">
				<div class="text-muted">
					Compartilhe
				</div>
				<div class="share d-inline-block">
					<!-- AddToAny BEGIN -->
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
					</div>
					<script async src="https://static.addtoany.com/menu/page.js"></script>
					<!-- AddToAny END -->
				</div>
			</div>
		</div>
		<div class="col-md-12 col-lg-8">

			<article class="article-post">
				<p>
					{!! $artigo->conteudo !!}
				</p>
			</article>

			<div class="border p-5 bg-lightblue">
				<div class="row justify-content-between">
					<div class="col-md-5 mb-2 mb-md-0">
						<h5 class="font-weight-bold secondfont">Seja um Membro</h5>
						Receba as últimas notícias diretamente na sua caixa de entrada. Nunca enviamos spam!
					</div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="Enter your e-mail address">
							</div>
							<div class="col-md-12 mt-2">
								<button type="submit" class="btn btn-success btn-block">Inscrever-se</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
<!-- End Main -->
    
@endsection