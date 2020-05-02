<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\User;

class UsuarioController extends Controller
{

    function telaListar() {
        $usuarios = User::all();
        return view("usuarios.listar", [ "us" => $usuarios ]);
    }

    function excluir($id){
        $usuario = User::find($id);


        if ($usuario->delete()){
            $msg = "Usuário $id excluído com sucesso.";
        } else {
            $msg = "Usuário não foi excluído.";
        }

        return view("resultado", [ "mensagem" => $msg]);
    }
}
