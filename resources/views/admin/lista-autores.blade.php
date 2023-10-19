
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($autores as $k => $item)

                    <tr>
                        <td>{{$item->id}}</td>
                        <td><img src="{{asset($item->foto)}}"class="img-circle" style="height:50px; width:50px;" ></td>
                        <td>{{$item->name}}</td>

                        <!-- TOGGLE SWITCH -->
                     @if($item->status == 'ativo')
                          <td>
                              <label class="switch">
                                <input type="checkbox" checked class="status" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td>
                     @else    
                           <td>
                              <label class="switch">
                                <input type="checkbox" class="status" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td> 
                    @endif
                        
                        <td><a href="{{route('admin.autores.editar',['id'=>$item->id])}}" class="btn-Consultar btn btn-secondary">Editar</a></td>
                        <td><a href="{{route('admin.autores.deletar',['id'=>$item->id])}}" class="deletar-button btn btn-danger">Deletar</a></td>
                    </tr>
                @endforeach  
               </tbody>
             
            </table>  


        

