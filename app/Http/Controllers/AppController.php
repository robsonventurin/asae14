<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Auth;

class AppController extends Controller
{
    function tela_login(){
    	return view('usuarios.login');
    }

    function index(){
    	return view('index');
    }

    function login(Request $req){
    	$login = $req->input('login');
    	$senha = $req->input('senha');

        $usuario = Usuario::where('login', '=', $login)->first();
        
    	if ($usuario and $usuario->senha == $senha){
            $variavel = [
                "login" => $login,
                "nome" => $usuario->nome
            ];
            session($variavel);
            
    		return redirect()->route('index');
    	} else {
    		return view("resultado", ["mensagem" => "Usuário ou senha inválidos."]);
    	}
    }

    function logout(){
        Auth::logout();
        
        return redirect()->route('login');
    }
}
