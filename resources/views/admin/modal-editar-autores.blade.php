
<form action="{{route('admin.autores.atualizar',['id'=>$autor->id])}}" id="formEditarAutor" enctype="multipart/form-data">
@csrf

    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Autor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- BODY -->
    <div class="modal-body">
       
        <div class="row">
            <!-- FOTO IMAGEM -->
            <div class=" col-4">
             
                <img src="{{asset(@$autor->foto)}}" class="carregar-foto img-circle" style="height:200px; width:200px;">
                <input type="hidden" class="caminho-oculto" name="caminho-oculto" value="{{$autor->foto}}">
            </div>
            <div class="col-4">
                <div class="mt-3 mb-3">
                    <label for="titulo" class="form-label pt-1">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{@$autor->name}}" required>
                </div>
                <div class="mt-3 mb-1">
                    <label for="capa" class="form-label">Foto (URL)</label>
                    <input type="file" name="fotoedit" id="fotoAutorEdit" accept="image/*">
                </div>
            </div>
        </div>
 
    </div>

    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >Atualizar</button>
    </div>

</form>
