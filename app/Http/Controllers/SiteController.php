<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Autor;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SiteController extends Controller
{
   
// INDEX - PRINCIPAL
    public function principal()
    {
        $categorias = Categoria::where('status','ativo')->get();
        //$autores = Autor::all();
        //$artigos = Artigo::all();

        $populares = Artigo::where('status','ativo')->orderBy('visitas','desc')->take(7)->get();
        $ultimo = Artigo::where('status','ativo')->latest('data_postagem')->first();
        $penultimo = Artigo::where('status','ativo')->latest('data_postagem')->skip(1)->first();
        $recentes = Artigo::where('status','ativo')->orderBy('data_postagem','asc')->take(4)->get();

        $aleatorio = Artigo::where('status','ativo')->inRandomOrder()->take(3)->get();

        return view('site.index', compact('categorias','populares', 'ultimo', 'penultimo', 'recentes', 'aleatorio'));
        
    }

// SHOW CATEGORIA
    public function showCategoria(Request $request, $id){

        //$artigos_categoria = Artigo::where('id_categoria', $id)->get();
        $categorias = Categoria::all();
        $ultimo = Artigo::where('id_categoria', $id)->where('status','ativo')->latest('data_postagem')->first();
        $recentes = Artigo::where('id_categoria', $id)->where('status','ativo')->where('id', '!=', $ultimo->id)->orderBy('data_postagem','asc')->get();
        $populares = Artigo::where('id_categoria', $id)->where('status','ativo')->orderBy('data_postagem','desc')->take(9)->get();
       
        
        return view('site.category', compact('categorias','recentes','populares','ultimo'));
    }

// SHOW ARTIGO    
    public function showArtigo(Request $request, $slug){

        //SLUG
        $artigo = Artigo::where('slug',$slug)->first();
        $artigo->increment('visitas');
        
        $autores = Autor::all();
        $categorias = Categoria::all();
       
        return view('site.article', compact('artigo', 'autores', 'categorias'));
    }

// BUSCAR
    public function buscarArtigos(Request $request) {

        $data = $request->input('buscar');
        
        $autores = Autor::all();
        $categorias = Categoria::all();

        $artigos = Artigo::where('titulo', 'like', "%$data%")->orWhere('resumo', 'like', "%$data%")->get();

        return view('site.buscar', compact('categorias','autores','artigos'));

    }   


}
