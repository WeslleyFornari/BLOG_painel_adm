@extends('layouts.appAdmin')

@section('content')
  <!--PAGINA DE CONTEUDO-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="row p-5">
           
          <div class="col-md-3">

                <h3>Adicionar / Atualizar</h3> 

                 <div id="resultado">
                    @include('admin.cadastrar-categorias')

                </div>
          </div>

        <!-- Lista de Categorias -->
          <div class="col-md-6 px-5 mx-5">
              <h3>Lista de Categorias</h3>

              <div id="lista-Categorias">
                    @include('admin.lista-categorias')
              </div>
              
          </div>
    </div>
</div>
@endsection

@section('script')
<!-- Script AJAX JQUERY -->
<script>

$(document).ready(function() {


// CONSULTAR
    //$("body").on('click',"#button-Consultar", function(e) {
    $(".button-Consultar").click(function (e) {

        e.preventDefault();
        var url = $(this).attr('href'); // EDIT -> http://localhost:8000/admin/autores/editar/5  
        console.log(url);

        $.ajax({
            url: url,
            type: "GET",
            //dataType: "TEXT",
            data: {},
            success: function (data) {
            
                $("#resultado").html(data); // GET - Retorna do Banco de dados {id}
            },    
        });
    });

// ATUALIZAR
    //$("#formEditarCategoria").submit(function(e) {
     $("body").on('submit','#formEditarCategoria', function(e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: $(this).attr('action'),  // ROUTE FORM {id} edit -> Action --->  http://localhost:8000/admin/autores/editar/5
            type: "POST",                 // POSTA NO CAMINHO ESCOLHIDO
            data: formData,
            
            success: function(response) {
            console.log(response)
            $("#lista-Categorias").html(response.lista);
            $("#resultado").html(response.form);
           
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

                    $("#lista-Categorias").html(response);
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
            url: '/admin/categorias/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'ativo',
            },
            success: function(response) {
                $("#lista-Categorias").html(response);
                console.log(response);
            }
            });

        }
        else{

            var id = $(this).data('id');
            var status = 'inativo';
            console.log(id);
            console.log(status);

            $.ajax({
            url: '/admin/categorias/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'inativo',
            },
            success: function(response) {
                $("#lista-Categorias").html(response);
                console.log(response);
            }
            });
        }

    });     
    
});

</script>
@endsection


