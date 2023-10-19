


<form action= "{{route('admin.categorias.salvar')}}" method="post">
@csrf

    <div class="mb-3 mt-4">
            <label for="genero" class="form-label">Categoria:</label>
            <input type="text" class="form-control" name="name" id="categoria" placeholder="Digite a categoria">
    </div>
                  
        <button type="submit" class="btn btn-primary">Salvar</button>
</form>