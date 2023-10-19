
<form id="salvarAutor" enctype="multipart/form-data">
@csrf

       <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Autor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
       </div>

    <!-- BODY -->
    <div class="modal-body">
       
        <div class="row">
            <!-- FOTO IMAGEM -->
            <div class=" col-4">
                <img src="{{asset('admin/img/autores/avatar-vazio.jpg')}}" class="carregar-foto img-circle" style="height:200px; width:200px;">
                <input type="hidden" class="caminho-oculto" name="caminho-oculto" value="">
            </div>
            <div class="col-4">
                <div class="mt-3 mb-3">
                    <label for="titulo" class="form-label pt-1">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="" required>
                </div>
                <div class="mt-3 mb-1">
                    <label for="capa" class="form-label">Foto (URL)</label>
                    <input type="file" name="foto" id="fotoAutor" required accept="image/*">
                </div>
            </div>
        </div>
 
    </div>

    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >Salvar</button>
    </div>

</form>