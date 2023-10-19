@extends('layouts.appAdmin')

@section('content')
  <!--PAGINA DE CONTEUDO - USUARIO-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Lista de Usuarios em Tabela -->
    <div class="col-md-11 p-5">

            <div class="row">

                <div class="col">
                    <h3>Lista</h3>
                </div>

                <div class="col" style="text-align:end;">  
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarAutor">
                      Cadastrar
                    </button> 

                </div>                    
            </div>

            <div class="lista-Autores">
                    @include('admin.lista-autores')
            </div>
            
    </div>
</div>

<!-- Modal Cadastro -->
<div class="modal fade" id="cadastrarAutor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
        <div class="modal-dialog modal-lg">
            
            <div class="modal-content" id="cadastrar-Autores" >
                @include('admin.modal-cadastrar-autores')
            </div>
        </div>

</div>

<!-- Modal Editar -->
<div class="editarAutor modal fade" id="modalEditarAutor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
        <div class="modal-dialog modal-lg">
            
                <div class="modal-content" id="editar-Autores">
                   
                </div>
        </div>

</div>

@endsection


@section('script')

<script>
$(document).ready(function() {

// CARREGAR FOTO - SALVAR 1
    $("#fotoAutor").change(function() {

        // Obter o arquivo de imagem
        var files = $('#fotoAutor')[0].files[0];

        var dataFoto = new FormData();
        // Enviar a imagem para o controlador para o upload
        dataFoto.append('fotoAutor',files);
        dataFoto.append('_token','{{csrf_token()}}');
        dataFoto.append('fotoOld', $('.caminho-oculto').val());

        
            $.ajax({
                url: '/admin/autores/uploadFoto',
                type: 'POST',
                data: dataFoto,
                contentType: false,
                processData: false,
                
                success: function(response) {
                    $(".carregar-foto").attr('src',response.caminhoCompleto); //retorna a imagem
                    $(".caminho-oculto").val(response.caminhoCurto); // retorna somente o valor
                    
                }                       
            });
     });  

// CARREGAR FOTO - EDITAR 2
    //$("#fotoAutorEdit").change(function() {
    $("body").on('change','#fotoAutorEdit',function(e){

    e.preventDefault();
    var files = $('#fotoAutorEdit')[0].files[0];

    var dataFoto = new FormData();
    // Enviar a imagem para o controlador para o upload
    dataFoto.append('fotoAutor',files);
    dataFoto.append('_token','{{csrf_token()}}');
    dataFoto.append('fotoOld', $('.caminho-oculto').val());

    console.log(dataFoto['fotoOld']);
    console.log(dataFoto['fotoAutor']);


        $.ajax({
            url: '/admin/autores/uploadFoto',
            type: 'POST',
            data: dataFoto,
            contentType: false,
            processData: false,
            
            success: function(response) {
                $(".carregar-foto").attr('src',response.caminhoCompleto); //retorna a imagem
                $(".caminho-oculto").val(response.caminhoCurto); // retorna somente o valor
                
            }                       
        });
    });  

// SALVAR DADOS
    $("#salvarAutor").submit(function(e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: '/admin/autores/salvar',
            type: "POST",
            data: formData,
            
            success: function(response) {

                $('#cadastrarAutor').modal('hide');
                $(".lista-Autores").html(response);
                // console.log(response); 
                // Fecha o modal (substitua '#seuModal' pelo seletor correto do seu modal)
                 
            },       
          });
    }); 
    
/* EDITAR
    $("body").on('click','.btn-Editar',function(e){

        e.preventDefault();
        var url = $(this).attr('href'); // EDIT -> http://localhost:8000/admin/autores/editar/5  

        $.get(url,function(data){
            $("#editar-Autores").html(data); // GET - Retorna do Banco de dados {id}
            $("#modalEditarAutor").modal('show') // Chama o Modal
            
        });
    }); */

// CONSULTAR
    $(".btn-Consultar").click(function (e) {

        e.preventDefault();
        var url = $(this).attr('href'); // EDIT -> http://localhost:8000/admin/autores/editar/5  

        $.ajax({
            url: url,
            type: "GET",
            //dataType: "TEXT",
            data: {},
            success: function (data) {
            
                $("#editar-Autores").html(data); // GET - Retorna do Banco de dados {id}
                $("#modalEditarAutor").modal('show') // Chama o Modal
                
            },    
        });
});

// ATUALIZAR
    $("body").on('submit','#formEditarAutor', function(e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: $(this).attr('action'),  // ROUTE FORM {id} edit -> Action --->  http://localhost:8000/admin/autores/editar/5
            type: "POST",                 // POSTA NO CAMINHO ESCOLHIDO
            data: formData,
            
            success: function(response) {
              console.log(response)
                $(".lista-Autores").html(response);
                $('#modalEditarAutor').modal('hide'); // fecha o Modal

                
            },       
        });
    });

// DELETAR
    $('.deletar-button').click(function(event) {

        var form =  $(this).closest("form");
        event.preventDefault(); // Impede o comportamento padrão do link

        swal({
            title: `Você tem certeza que deseja apagar as informações?`,
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                var url = $(this).attr('href'); // Pega a route{id} EDIT -> DELETE
                console.log(url);

                $.ajax({
                    url: url,
                    type: "GET",

                    success: function(response) {

                    $(".lista-Autores").html(response);
                    },       
                });
                }
            });
    });

// TOGGLE SWITCH ATIVO -> INATIVO
    $(".status").change(function() {
        
        if ($(this).is(":checked")) {

            var id = $(this).data('id');
            var status = 'ativo';
            // var valorSelect2 = $("#genero").val();
            console.log(id);
            console.log(status);
            
            $.ajax({
            url: '/admin/autores/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'ativo',
            },
            success: function(response) {
                $("#lista-Autores").html(response);
                
            }
            });

        }
        else{

            var id = $(this).data('id');
            var status = 'inativo';
            console.log(id);
            console.log(status);

            $.ajax({
            url: '/admin/autores/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'inativo',
            },
            success: function(response) {
                $("#lista-Autores").html(response);
                console.log(response);
            }
            });
        }
        });     
});

</script>
@endsection


