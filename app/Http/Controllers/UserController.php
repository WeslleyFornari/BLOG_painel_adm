<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


// LISTA
    public function listaUsuarios()
    {
        $users = User::all();
                
        return view('admin.usuarios', compact('users'));
    } 

// SALVAR
    public function salvar(Request $request){

        $data = $request->all();

        // Valide os dados do formulário, se necessário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Verifica se o email já existe no banco de dados
            'password' => 'required|string|min:8|confirmed|', // Validação da senha
        ]);
    
    User:: create([
        'name'=> $data['nome'],
        'email'=> $data['email'],
        'password'=> bcrypt($data['password']),
        'is_admin'=> $data['is_admin'],
    ]);

    return redirect()->route('admin.usuarios');
    }

// DELETAR
public function deletar(Request $request,$id)   {

    $user = User::find($id);
   
    $user-> delete();

    return redirect()->route('admin.usuarios');
}

//EDIT
public function editar(Request $request, $id){
    
    $user = User::find($id);
    return view('admin.usuarios-edit', compact('user'));
}

//SELECT STATUS
public function statusUsuarios(Request $request){

    $data = $request->all();
    User::where('id',$data['id'])->update(['status'=> $data['status']]);

    $users = User::all();
    
    return view('admin.lista-usuarios', compact('users'));
 }

}
