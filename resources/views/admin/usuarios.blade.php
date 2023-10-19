@extends('layouts.appAdmin')

@section('content')
  <!--PAGINA DE CONTEUDO - USUARIO-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Lista de Usuarios em Tabela -->
    <div class="col-md-11 p-5">

            <div class="row">
                <div class="col">
                    <h3>Lista de Usuarios</h3>
                </div>

                <div class="col" style="text-align:end;">
                    <td><a href="#" class="btn btn-primary">Cadastrar</a></td>
                </div>                    
            </div>

            <div id="lista-Usuarios">
                    @include('admin.lista-usuarios')
              </div>

            
    </div>
 
</div>
@endsection

@section('script')

<script>
$(document).ready(function() {   

// DELETAR
$('.deletar-Button2').click(function(event) {

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

            $("#lista-Usuarios").html(response);
            },       
        });
        }
    });
});

// TOGGLE SWITCH ATIVO -> INATIVO
    $(".status3").change(function() {
        
        if ($(this).is(":checked")) {

            var id = $(this).data('id');
            var status = 'ativo';
            // var valorSelect2 = $("#genero").val();
            console.log(id);
            console.log(status);
            
            $.ajax({
            url: '/admin/usuarios/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'ativo',
            },
            success: function(response) {
                $("#lista-Usuarios").html(response);
                
            }
            });

        }
        else{

            var id = $(this).data('id');
            var status = 'inativo';
            console.log(id);
            console.log(status);

            $.ajax({
            url: '/admin/usuarios/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'inativo',
            },
            success: function(response) {
                $("#lista-Usuarios").html(response);
                console.log(response);
            }
            });
        }
        }); 

});
    
</script>

@endsection


