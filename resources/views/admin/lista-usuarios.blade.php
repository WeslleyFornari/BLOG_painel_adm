

            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>

                <!--BODY-->
                <tbody id="listaUsuarios">
                @foreach($users as $k => $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>

                <!-- TOGGLE SWITCH -->
                @if($item->status == 'ativo')
                          <td>
                              <label class="switch">
                                <input type="checkbox" checked class="status3" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td>
                     @else    
                           <td>
                              <label class="switch">
                                <input type="checkbox" class="status3" data-id="{{$item->id}}">
                                <span class="slider round"></span>
                              </label>
                          </td> 
                    @endif
                        
                        <td><a href="#" class="btn btn-info">Editar</a></td>
                        <td><a href="{{route('admin.usuarios.deletar',['id'=>$item->id])}}" class="deletar-Button2 btn btn-danger">Deletar</a></td>        
                    </tr>
                @endforeach  
               </tbody>
            </table>
        

