<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    
// LISTA
    public function Autores()
    {
        $autores = Autor::all();
                
        return view('admin.autores', compact('autores'));
    } 

//UPLOAD IMAGEM
    public function uploadFoto(Request $request)   {

        $data = $request->all();
   
        // Valide os dados do formulário, se necessário
        $request->validate(['fotoAutor' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024']);

        if($data['fotoOld'] != "") {
           
            @unlink($data['fotoOld']);
            
        }    
        
        // Salve a imagem no sistema de arquivos (storage/app/public)
         $imagemPath = $request->file('fotoAutor')->store('admin/img/autores');
       
        //return asset($imagemPath);

        return response()->json(['caminhoCompleto' => asset($imagemPath),
                                    'caminhoCurto' => $imagemPath
                               ]); 
        }

// SALVAR
    public function salvarAutores(Request $request){

    $data=$request->except('_token');
           
    
    Autor:: create([
        'foto'=> $data['caminho-oculto'],
        'name'=> $data['name'],
        
    ]);

    $autores = Autor::all();
    return view('admin.lista-autores', compact('autores'));
    }

// DELETAR
    public function deletarAutores(Request $request,$id)   {

        $autores = Autor::find($id);
        unlink($autores->foto);
        $autores-> delete();

        $autores = Autor::all();
        return view('admin.lista-autores', compact('autores'));
    }    


// EDITAR
    public function editarAutores(Request $request,$id)   {

       $autor = Autor::find($id);
       return view('admin.modal-editar-autores',compact('autor'));
       //return response()->json($autor);
       
    }

//UPDATE   
    public function atualizarAutores(Request $request,$id)   {
        
        $data=$request->except('_token'); //recebe as informações no objeto.
       
        Autor::where('id',$id)->update([
            'foto'=> $data['caminho-oculto'],
            'name'=> $data['name'],
        ]);

        $autores = Autor::all();

        //redirect()->route()
        return view('admin.lista-autores', compact('autores'));

    }

//SELECT STATUS
    public function statusAutores(Request $request){

        $data = $request->all();

        Autor::where('id',$data['id'])->update(['status'=> $data['status']]);

        //$autores = Autor::all();
        
        return view('admin.lista-autores', compact('autores'));
    
    }


    

}



