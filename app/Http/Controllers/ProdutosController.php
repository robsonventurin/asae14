<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\TipoProdutos;

class ProdutosController extends Controller
{
    function telaListar() {        
        $lista = Produtos::all();
        return view('produtos.listar', [ "lista" => $lista]);
    }

    function telaCadastro() {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $t = TipoProdutos::all();
        return view('produtos.cadastrar', ["t" => $t]);
    }

    function telaAlterar($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $p = Produtos::find($id);
        $t = TipoProdutos::all();
        return view('produtos.alterar', ["t" => $t, "p" => $p]);
    }

    function adicionar(Request $req) {
        $valor_unitario = $req->input("valor_unitario");
        $valor_unitario = str_replace('R$ ', '', str_replace(',','.', str_replace('.', '', $valor_unitario)));
        
        $v = new Produtos();
        $v->nome = $req->input("nome");
        $v->id_tipo_produtos = $req->input("id_tipo_produtos");
        $v->valor_unitario = $valor_unitario;

        if ($v->save()) {
            $msg = "Produto adicionado com sucesso.";
        } else {
            $msg = "Produto não adicionado. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }

    function alterar(Request $req, $id) {
        $valor_unitario = $req->input("valor_unitario");
        $valor_unitario = str_replace('R$ ', '', str_replace(',','.', str_replace('.', '', $valor_unitario)));

        $v = Produtos::find($id);
        $v->nome = $req->input("nome");
        $v->id_tipo_produtos = $req->input("id_tipo_produtos");
        $v->valor_unitario = $valor_unitario;

        if ($v->save()) {
            $msg = "Produto alterado com sucesso.";
        } else {
            $msg = "Produto não alterado. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }

    function excluir($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }
        
        $c = Produtos::find($id);

        if ($c->delete()) {
            $msg = "Produto '$c->nome' excluído com sucesso.";
        } else {
            $msg = "Produto não foi excluído. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }
}
