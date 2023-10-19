@extends('layouts.appAdmin')

@section('content')
  <!--PAGINA DE CONTEUDO-->
<div class="content-wrapper">
<div class="container"> 

<!-- FORMULARIO -->

<form action="{{route('admin.artigos.atualizar',['id'=>$artigo->id])}}" id="formEditarArtigo" enctype="multipart/form-data">
@csrf
<div class="row px-5 py-3 mt-3">

<!-- COLUNA 1 -->
    <div class="col-8">

    <div class="row mb-3">
      <!-- TITULO -->
          <div class="col-6">
              <p>Titulo:</p>
              <input type="text" class="form-control" name="titulo" id="titulo" value="{{$artigo->titulo}}" required>
          </div>
      <!-- URL -->
          <div class="col-6">
         <p>Url:</p>
              <input type="text" class="form-control" name="url" id="url" value="{{$artigo->url}}" readonly >
          </div>
    </div>

       <!-- RESUMO -->
          <div class="row">
              <div class="col">
                <p>Resumo:</p>
                  <textarea rows="2" class="form-control" cols="40" name="resumo" id="resumo" required>{{$artigo->resumo}}</textarea>
                
              </div>
        </div>
       <!-- CONTEUDO SUMMER NOTE -->
          <div class="row mt-3">
              <div class="col">
              <p>Conteúdo:</p>
                    <textarea id="summernote" name="conteudo" rows="5" cols="40" class="form-control"  style=" height: 400px; width: 200px;">{{$artigo->conteudo}}</textarea>
              </div>
        </div>
    </div>


<!-- COLUNA 2 -->
    <div class="col-3 mx-4">
       <!-- STATUS -->
        <div class="row">
              <div class="col-12 mb-3 text-center">
                  <button type="submit" class="btn btn-primary" >Atualizar Conteúdo</button>
              </div>

              <div class="col">
                  Status:
              </div>
               
              <div class="col">
                  Ativo: <input type="radio" name="status" id="status" value="ativo">
              </div>
              <div class="col">
                  Inativo: <input type="radio" name="status" id="status" value="inativo">
              </div>
        </div>

        <!-- AUTOR -->
        <div class="row mt-3">
              <div class="col-12">
                  <p>Autor:</p>
              </div>

              <div class="col-12">
                  <select name="autor" id="autor" required class="form-control">
                        <option value="">Selecione</option>
                        @foreach($autores as $k => $item)
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                        @endforeach
                  </select>
              </div>
        </div>

       <!-- CATEGORIA -->
        <div class="row mt-3">
            <div class="col-12">
                <p>Categoria:</p>
            </div>

              <div class="col-12">
                  <select name="categoria" id="categoria"  required class="form-control">
                  <option value="">Selecione</option>
                        @foreach($categorias as $k => $item)
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                        @endforeach
                  </select>
              </div>      
        </div>

       <!-- UPLOAD -->
        <div class="row mt-3">

              <div class="col-12">
                    <p>Imagem em Destaque:</p>
              </div>

              <div class="col-12">
                    <input type="file" name="foto" id="fotoArtigo" accept="image/*">
              </div>          
        </div>

        <!-- IMAGEM -->
        <div class="row mt-3">
                    
              <img src="{{asset($artigo->foto)}}" class="carregar-foto1 img" style= "margin-left:40px; height:130px; width:200px;">
                <input type="hidden" class="caminho-oculto1" name="caminho-oculto1" value="{{$artigo->foto}}"> 
        </div>
        
    </div>

</div>
</form>
<!-- END FORMULARIO -->

</div>  
</div>
@endsection

@section('script')
<script>

$(document).ready(function() {

  $('#summernote').summernote();

  });

// CARREGAR FOTO - ARTIGO
    $("#fotoArtigo").change(function() {

        // Obter o arquivo de imagem
        var files = $('#fotoArtigo')[0].files[0];

        var dataFoto = new FormData();
        // Enviar a imagem para o controlador para o upload
        dataFoto.append('fotoArtigo',files);
        dataFoto.append('_token','{{csrf_token()}}');
        dataFoto.append('fotoOld', $('.caminho-oculto1').val());

        
            $.ajax({
                url: '/admin/artigos/uploadFoto',
                type: 'POST',
                data: dataFoto,
                contentType: false,
                processData: false,
                
                success: function(response) {
                    $(".carregar-foto1").attr('src',response.caminhoCompleto1); //retorna a imagem
                    $(".caminho-oculto1").val(response.caminhoCurto1); // retorna somente o valor
                    
                }                       
            });
     });  

// ATUALIZAR
    $("body").on('submit','#formEditarArtigo', function(e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: $(this).attr('action'),  // ROUTE FORM {id} edit -> Action --->  http://localhost:8000/caminho
            type: "POST",                 // POSTA NO CAMINHO ESCOLHIDO
            data: formData,
            
            success: function(response) {
                
                console.log(response)
                
                swal({
                    title: `Informações atualizadas com sucesso!`,
                    text: "",
                    icon: 'success', // Pode ser 'info', 'success', 'error' etc.
                    showCancelButton: false, // Defina como false para remover o botão de cancelar
                    confirmButtonText: 'Ok'
                    })

                .then((willConfirmation) => {
                    if (willConfirmation) {

                        window.location.href = "{{route('admin.artigos')}}"  
                }
                });
               
               

            },       
       });
    });
   

</script>
@endsection


