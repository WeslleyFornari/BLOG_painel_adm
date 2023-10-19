@extends('layouts.appAdminArtigo')

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
                    <td><a href="{{route('admin.artigos.cadastrar')}}" class="btn btn-primary">Cadastrar</a></td>
                </div>   

            </div>

            <div id="lista-Artigos">
                    @include('admin.lista-artigos')
            </div>
            
    </div>
</div>


@endsection


@section('script')

<script>
$(document).ready(function() {


// DELETAR
    $('.deletar-Button1').click(function(event) {

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

                    $("#lista-Artigos").html(response);
                    },       
                });
                }
            });
    });

// TOGGLE SWITCH ATIVO -> INATIVO
    $(".status1").change(function() {
        
        if ($(this).is(":checked")) {

            var id = $(this).data('id');
            var status = 'ativo';
            // var valorSelect2 = $("#genero").val();
            console.log(id);
            console.log(status);
            
            $.ajax({
            url: '/admin/artigos/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'ativo',
            },
            success: function(response) {
                $("#lista-Artigos").html(response);
                
            }
            });

        }
        else{

            var id = $(this).data('id');
            var status = 'inativo';
            console.log(id);
            console.log(status);

            $.ajax({
            url: '/admin/artigos/status',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: 'inativo',
            },
            success: function(response) {
                $("#lista-Artigos").html(response);
                console.log(response);
            }
            });
        }
        }); 
   
// ORDENAR
//$('#tabela-ordenar th').click(function() {
    var lastClicked = null; 
    var lastOrder = 'asc'; // Inicializa com 'asc' para a primeira ordenação
    
    $(document).on('click', '#tabela-ordenar th', function(){

        var coluna = $(this).data('col');
        var ordem;
        ordem = (lastOrder === 'asc') ? 'desc' : 'asc';
        if (this === lastClicked) {
        // Se o mesmo elemento foi clicado novamente, alternar entre 'asc' e 'desc'
        
        lastOrder = ordem; // Atualiza a última ordem
    } else {
        // Se for um novo elemento, começar com 'asc'
       
        lastClicked = this; // Atualiza o último elemento clicado
        lastOrder = ordem; // Atualiza a última ordem
    }

    // Remove as classes de todos os elementos <th>
    $('#tabela-ordenar th').removeClass('asc desc');

    // Define a classe no elemento atual
    $(this).addClass(ordem);

        $.get("{{route('admin.artigos.ordenar')}}", { coluna: coluna, ordem: ordem }, function(data) {

            $("#lista-Artigos").html(data);
            console.log(data)
            
        });
    });

// EFEITO MOUSE
        $('#tabela-ordenar th').hover(function() {  

            $(this).addClass('hover-effect');
            }, function() {
            $(this).removeClass('hover-effect');
        });

// SELECT BUSCAS
        $("#autor").change(function() {
            enviarSelecao();
        });
        // Use o evento "change" para detectar a mudança de seleção no segundo select
        $("#categoria").change(function() {
            enviarSelecao();
        });

        $("#procurar").on('input', function() {
            enviarSelecao();
    
        });
        // Função para enviar os dados selecionados para Laravel usando AJAX
        function enviarSelecao() {
            var valorSelect1 = $("#autor").val();
            var valorSelect2 = $("#categoria").val();
            var valorSelect3 = $("#procurar").val().toLowerCase();

            console.log(valorSelect1);
            console.log(valorSelect2);
            console.log(valorSelect3);
        
            // Envie os valores para a rota em Laravel usando AJAX
            $.ajax({
                url: "/admin/artigos/procurar",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id_autor: valorSelect1,
                    id_categoria: valorSelect2,
                    procurar: valorSelect3
                },
                success: function(response) {
                    $("#lista-Artigos").html(response);
                    console.log(response);
                },
                error: function(error) {
                    // Lide com erros aqui
                    console.error(error);
                },
                complete: function () {
                    // Código a ser executado após a conclusão da solicitação, independentemente de sucesso ou erro
                    // Exemplo: Ocultar o indicador de carregamento
                }
            });
        }


});

</script>
@endsection


