<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    
// LISTA
    public function listaCategorias()
    {
        $categorias = Categoria::all();
                
        return view('admin.categorias', compact('categorias'));
    } 

// SALVAR
    public function salvarCategorias(Request $request){

        $categoria = $request->except('_token');

        Categoria:: create([

            'name'=> $categoria['name']
            
        ]);
        return redirect()->route('admin.categorias');
    }


// EDITAR
        public function editarCategorias(Request $request,$id)   {

            $categorias = Categoria::find($id);
           
            return view('admin.editar-categorias',compact('categorias'));
            //return response()->json($autor);
            
        }    

// UPDATE   
    public function atualizarCategorias(Request $request,$id)   {
        
        $data=$request->except('_token'); //recebe as informações no objeto.
     
        Categoria::where('id',$id)->update([
            'name'=> $data['name'],
        ]);

        $categorias = Categoria::all();

        //redirect()->route()
        return response()->json([
            'form' => view('admin.cadastrar-categorias')->render(),
            'lista' => view('admin.lista-categorias', compact('categorias'))->render(),
        ]);
    

    }

// DELETAR
public function deletarCategorias(Request $request,$id)   {

    $categorias = Categoria::find($id);
    $categorias-> delete();

    $categorias = Categoria::all();
    return view('admin.lista-categorias', compact('categorias'));
}    

//SELECT STATUS
    public function statusCategorias(Request $request){

        $data = $request->all();
        Categoria::where('id',$data['id'])->update(['status'=> $data['status']]);
        
        
        return view('admin.lista-categorias', compact('categorias'));
        
        }



       
    
}


