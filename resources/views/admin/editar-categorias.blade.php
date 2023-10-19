

<form action="{{route('admin.categorias.atualizar',['id'=>$categorias->id])}}" id="formEditarCategoria" enctype="multipart/form-data">
@csrf

    <div class="mb-3 mt-4" id="editarCategoria" >
            <label for="genero" class="form-label">Categoria:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$categorias->name}}">
    </div>
                  
        <button type="submit" class="btn btn-warning">Atualizar</button>
</form>