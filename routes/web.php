<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
Route::get('/auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [SiteController::class, 'principal'])->name('principal');
Route::get('/site/categoria/show/{id}', [SiteController::class,'showCategoria'])->name('site.categoria.show');
Route::get('/site/artigo/show/{slug}', [SiteController::class,'showArtigo'])->name('site.artigo.show');
Route::get('/site/artigos/buscar', [SiteController::class, 'buscarArtigos'])->name('artigos.buscar');

// ADMIN
Route::middleware(['web', 'auth', 'checkUserStatus'])->prefix('admin/')->name('admin.')->group(function () {

    Route::get('/usuarios', [UserController::class, 'listaUsuarios'])->name('usuarios');
    Route::post('/usuarios/salvar', [UserController::class,'salvarUsuarios'])->name('usuarios.salvar');
    Route::get('/usuarios/editar/{id}', [UserController::class, 'editarUsuarios'])->name('usuario.editar');
    Route::get('/usuarios/deletar/{id}', [UserController::class, 'deletarUsuarios'])->name('usuarios.deletar');
    Route::post('/usuarios/status', [UserController::class, 'statusUsuarios'])->name('usuarios.status');

    Route::get('/categorias', [CategoriaController::class, 'listaCategorias'])->name('categorias');
    Route::post('/categorias/salvar', [CategoriaController::class, 'salvarCategorias'])->name('categorias.salvar');
    Route::post('/categorias/status', [CategoriaController::class, 'statusCategorias'])->name('categorias.status');
    Route::get('/categorias/editar/{id}', [CategoriaController::class,'editarCategorias'])->name('categorias.editar');
    Route::get('/categorias/deletar/{id}', [CategoriaController::class, 'deletarCategorias'])->name('categorias.deletar');
    Route::post('/categorias/atualizar/{id}', [CategoriaController::class,'atualizarCategorias'])->name('categorias.atualizar');
    
    Route::get('/autores', [AutorController::class, 'Autores'])->name('autores');
    Route::post('/autores/uploadFoto', [AutorController::class, 'uploadFoto'])->name('autores.uploadFoto');
    Route::post('/autores/salvar', [AutorController::class, 'salvarAutores'])->name('autores.salvar');
    Route::get('/autores/deletar/{id}', [AutorController::class, 'deletarAutores'])->name('autores.deletar');
    Route::post('/autores/status', [AutorController::class, 'statusAutores'])->name('autores.status');
    Route::get('/autores/editar/{id}', [AutorController::class,'editarAutores'])->name('autores.editar');
    Route::post('/autores/atualizar/{id}', [AutorController::class,'atualizarAutores'])->name('autores.atualizar');
    
    
    Route::get('/artigos', [ArtigoController::class, 'listaArtigos'])->name('artigos');
    Route::post('/artigos/uploadFoto', [ArtigoController::class, 'uploadFoto'])->name('artigo.uploadFoto');
    Route::get('/artigos/cadastrar', [ArtigoController::class, 'cadastrarArtigos'])->name('artigos.cadastrar');
    Route::post('/artigos/salvar', [ArtigoController::class, 'salvarArtigos'])->name('artigos.salvar');
    Route::post('/artigos/status', [ArtigoController::class, 'statusArtigos'])->name('artigos.status');
    Route::get('/artigos/deletar/{id}', [ArtigoController::class, 'deletarArtigos'])->name('artigos.deletar');
    Route::get('/artigos/editar/{id}', [ArtigoController::class,'editarArtigos'])->name('artigos.editar');
    Route::post('/artigos/atualizar/{id}', [ArtigoController::class,'atualizarArtigos'])->name('artigos.atualizar');
    Route::get('/artigos/ordenar', [ArtigoController::class, 'ordenarArtigos'])->name('artigos.ordenar');
    Route::post('/artigos/procurar', [ArtigoController::class, 'procurarArtigos'])->name('artigos.procurar');
});   
