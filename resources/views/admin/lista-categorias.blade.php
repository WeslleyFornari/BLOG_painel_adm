
   <table class="table mt-4">

              <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>

                <!--BODY-->
                  <tbody>    
                      @foreach($categorias as $k => $item)

                      <tr>
                          <td>{{$item->id}}</td>
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
                    
                          <td><a href="{{route('admin.categorias.editar',['id'=>$item->id])}}" class="button-Consultar btn btn-secondary">Editar</a></td>
                          <td><a href="{{route('admin.categorias.deletar',['id'=>$item->id])}}" class="deletar-button btn btn-danger">Deletar</a></td>
                    </tr>
                    @endforeach
                  </tbody>  
    </table>  