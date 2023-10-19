<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Autor;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtigoController extends Controller
{

 // LISTA
    public function listaArtigos()
    {
        $artigos = Artigo::all();
        $autores = Autor::all();
        $categorias = Categoria::all();
                
        return view('admin.artigos', compact('artigos', 'autores', 'categorias'));
    } 

//UPLOAD IMAGEM
      public function uploadFoto(Request $request)   {

         $data = $request->all();

         // Valide os dados do formulário, se necessário
         $request->validate(['fotoArtigo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024']);

         if($data['fotoOld'] != "") {
            
            @unlink($data['fotoOld']);
            
         }    
         
         // Salve a imagem no sistema de arquivos (storage/app/public)
         $imagemPath = $request->file('fotoArtigo')->store('admin/img/artigos');
      
         //return asset($imagemPath);

         return response()->json(['caminhoCompleto1' => asset($imagemPath),
                                    'caminhoCurto1' => $imagemPath
                              ]); 
         }

 // CADASTRAR
      public function cadastrarArtigos(){

         $categorias = Categoria::all();
         $autores = Autor::all();

         return view('admin.cadastrar-artigos', compact('categorias', 'autores'));
      }

// SALVAR
      public function salvarArtigos(Request $request){

            $data = $request->all();
            $slug = Str::slug($data['titulo']);
            // Criar um slug combinando título e categoria
            $slug = Str::slug($data['categoria'] . '-' . $data['titulo']);
            
            Artigo::create([
               'foto' => $data['caminho-oculto1'],
               'status'=> $data['status'],
               'titulo'=> $data['titulo'],
               'resumo'=> $data['resumo'],
               'url'=> $slug,
               'conteudo'=> $data['conteudo'],
               'id_categoria'=> $data['categoria'],
               'id_autor'=> $data['autor'],
               'data_postagem' => Carbon::now()->format('Y-m-d H:i:s'),

            ]);
          
          return response()->json(['status'=>'ok']);
      }

// EDITAR
      public function editarArtigos(Request $request,$id)   {

         $artigo = Artigo::find($id);
         $categorias = Categoria::all();
         $autores = Autor::all();

         return view('admin.editar-artigos',compact('artigo', 'categorias', 'autores'));
         
      }

//UPDATE   
      public function atualizarArtigos(Request $request,$id)   {
         
         $data=$request->except('_token'); //recebe as informações no objeto.
         
         Artigo::where('id',$id)->update([

               'foto' => $data['caminho-oculto1'],
               'status'=> $data['status'],
               'titulo'=> $data['titulo'],
               'resumo'=> $data['resumo'],
               'url'=> $data['url'],
               'conteudo'=> $data['conteudo'],
               'id_categoria'=> $data['categoria'],
               'id_autor'=> $data['autor'],
         ]);

         return response()->json(['status'=>'ok']);
      }

// DELETAR
      public function deletarArtigos(Request $request,$id)   {

         $artigos = Artigo::find($id);
         unlink($artigos->foto);
         $artigos-> delete();

         $artigos = Artigo::all();
         return view('admin.lista-artigos', compact('artigos'));
      } 

//SELECT STATUS
      public function statusArtigos(Request $request){

         $data = $request->all();
        
         Artigo::where('id',$data['id'])->update(['status'=> $data['status']]);

         $artigos = Artigo::all();
         
         return view('admin.lista-artigos', compact('artigos'));
      }

// ORDENAR
public function ordenarArtigos(Request $request){

        $coluna = $request->input('coluna');
        $ordem = $request->input('ordem');

        $artigos = Artigo::query();
        
        $artigos = Artigo::query();

    if ($coluna == 'id_categoria') {
        $artigos->join('categorias', 'artigos.id_categoria', '=', 'categorias.id')
            ->orderBy('categorias.name', $ordem);
    } elseif ($coluna == 'id_autor') {
        $artigos->join('autors', 'artigos.id_autor', '=', 'autors.id')
            ->orderBy('autors.name', $ordem);
    } else {
        $artigos->orderBy($coluna, $ordem);
    }

    $artigos = $artigos->get();

    $autores = Autor::all();
    $categorias = Categoria::all();
  
        return view('admin.lista-artigos', compact('artigos', 'autores', 'categorias'));
    } 

//SELECT PROCURAR
    public function procurarArtigos(Request $request){

      $selecao = $request->all();
      
      $autores = Autor::all();
      $categorias = Categoria::all();

      $artigos = Artigo::query();

      if($selecao['id_autor'] != "")
      {
          $artigos->where('id_autor', $selecao['id_autor']);
      }
      
      if($selecao['id_categoria'] != "")
      {
          $artigos->where('id_categoria', $selecao['id_categoria']);
      }

      if($selecao['procurar'] != "")
      {
          
          $artigos->whereRaw('LOWER(titulo) LIKE ?', ['%' . $selecao['procurar'] . '%'])->get();
      }

      $artigos = $artigos->get();      
      return view('admin.lista-artigos', compact('autores','categorias', 'artigos'));
  }

}
