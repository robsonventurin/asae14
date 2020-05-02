<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProdutos;

class TipoProdutosController extends Controller
{
    function telaListar() {        
        $lista = TipoProdutos::all();
        return view('tipos_produtos.listar', [ "lista" => $lista]);
    }

    function telaCadastro() {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        return view('tipos_produtos.cadastrar');
    }

    function telaAlterar($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $t = TipoProdutos::find($id);
        return view('tipos_produtos.alterar', ["t" => $t]);
    }

    function adicionar(Request $req) {
        
        $v = new TipoProdutos();
        $v->nome = $req->input("nome");
        $v->descricao = $req->input("descricao");

        if ($v->save()) {
            $msg = "Tipo de produto adicionado com sucesso.";
        } else {
            $msg = "Tipo de produto não adicionado. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }

    function alterar(Request $req, $id) {
        
        $v = TipoProdutos::find($id);
        $v->nome = $req->input("nome");
        $v->descricao = $req->input("descricao");

        if ($v->save()) {
            $msg = "Tipo de produto alterado com sucesso.";
        } else {
            $msg = "Tipo de produto não alterado. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }

    function excluir($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }
        
        $c = TipoProdutos::find($id);

        if ($c->delete()) {
            $msg = "Tipo de produto '$c->nome' excluído com sucesso.";
        } else {
            $msg = "Tipo de produto não foi excluído. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }


}
