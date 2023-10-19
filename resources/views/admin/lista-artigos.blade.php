
            <table class="table mt-5" id="tabela-ordenar" >
                <thead>
                    <tr>
                        <th scope="col" class="hover-effect" data-col="titulo">Titulo</th>
                        <th scope="col" class="hover-effect" data-col="id_autor">Autor</th>
                        <th scope="col" class="hover-effect" data-col="id_categoria">Categoria</th>
                        <th scope="col" class="hover-effect" data-col="data_postagem">Data</th>
                        
                        <th scope="col">Status</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>

            
                <tbody>
                @foreach($artigos as $k => $item)
                    <tr>
                        <td>{{$item->titulo}}</td>
                        <td>{{$item->autor->name}}</td>
                        <td>{{$item->categoria->name}}</td>
                        <td>{{$item->data_postagem}}</td>

                <!-- TOGGLE SWITCH -->
                     @if($item->status == 'ativo')
                          <td>
                              <label class="switch">
                                <input type="checkbox" checked class="status1" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td>
                     @else    
                           <td>
                              <label class="switch">
                                <input type="checkbox" class="status1" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td> 
                    @endif

                        <td><a href="{{route('admin.artigos.editar',['id'=>$item->id])}}" class="btn-Consultar1 btn btn-secondary">Editar</a></td>
                        <td><a href="{{route('admin.artigos.deletar',['id'=>$item->id])}}" class="deletar-Button1 btn btn-danger">Deletar</a></td>
                    </tr>
                @endforeach  
               </tbody>
             
            </table>  


