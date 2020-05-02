<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venda;
use App\Produtos;
use App\Cliente;

class VendaController extends Controller
{
    function telaCadastro() {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $cliente = Cliente::all();
        return view('vendas.cadastrar', [ "clientes" => $cliente]);
    }

    function telaAlterar($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $cliente = Cliente::all();
        $v = Venda::find($id);
        return view('vendas.alterar', [ "clientes" => $cliente, "venda" => $v]);
    }

    function telaCadastroItem($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $v = Venda::find($id);
        $produtos = Produtos::all();
        return view('vendas.cadastrar_item', [ "venda" => $v, "produtos" => $produtos ]);
    }

    
    function telaListar() {        
        $lista = Venda::all();
        return view('vendas.listar', [ "vendas" => $lista]);
    }

    function telaListarVendasPorCliente($id){
        $cliente = Cliente::find($id);
        return view('vendas.listar', ["vendas" => $cliente->vendas, "cliente" => $cliente]);
    }

    function adicionar(Request $req) {
        $valor_total = $req->input("valor_total");
        $valor_total = str_replace('R$ ', '', str_replace(',','.', str_replace('.', '', $valor_total)));

        $v = new Venda();
        $v->id_cliente = $req->input("id_cliente");
        $v->descricao = $req->input("descricao");
        $v->valor_total = 0;

        if ($v->save()) {
            $msg = "Venda para '" . $v->cliente->nome . "' adicionada com sucesso.";
        } else {
            $msg = "Venda não foi adicionada. Favor entrar em contato com o suporte.";
        }
        
        return redirect()->route('cadastrar_venda_item', ["id" => $v->id]);
    }

    function adicionarItem(Request $req, $id) {

        $produto = Produtos::find($req->input("id_produto"));
        $venda = Venda::find($id);

        $subtotalAgora = $produto->valor_unitario * $req->input('quantidade');
        $subtotal = $subtotalAgora;
        $quantidade = $req->input('quantidade');
        $find = false;

        $v = Venda::find($id);
        foreach($v->produtos as $p) {
            if ($p->id == $req->input("id_produto")) {
                $subtotal = $subtotal + $p->pivot->subtotal;
                $quantidade = $quantidade + $p->pivot->quantidade;
                $find = true;
                break;
            }
        }

        if ($find)
            $venda->produtos()->updateExistingPivot($produto->id, ['quantidade'=>$quantidade, 'subtotal'=>$subtotal], false);
        else 
            $venda->produtos()->attach($produto->id, ['quantidade'=>$quantidade, 'subtotal'=>$subtotal]);

        $venda->valor_total = $venda->valor_total + $subtotalAgora;
        $venda->save();
        
        return redirect()->route('cadastrar_venda_item', ["id" => $venda->id]);
    }

    function alterar(Request $req, $id) {
        $valor_total = $req->input("valor_total");
        $valor_total = str_replace('R$ ', '', str_replace(',','.', str_replace('.', '', $valor_total)));

        $v = Venda::find($id);
        $v->id_cliente = $req->input("id_cliente");
        $v->descricao = $req->input("descricao");
        //$v->valor_total = $valor_total;

        if ($v->save()) {
            $msg = "Venda #'$v->id' alterada com sucesso.";
        } else {
            $msg = "Venda não foi alterada. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }


    function excluir($id) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }
        
        $v = Venda::find($id);

        if ($v->delete()) {
            $msg = "Venda #'$v->id' excluída com sucesso.";
        } else {
            $msg = "Venda não foi excluída. Favor entrar em contato com o suporte.";
        }
        
        return view('resultado', [ "mensagem" => $msg]);
    }

    function excluirItem($id, $id_produto) {
        if (!session()->has('login')) {
            return redirect()->route('tela_login');
        }

        $subtotal = 0;        
        $v = Venda::find($id);
        foreach($v->produtos as $p) {
            if ($p->id == $id_produto) {
                $subtotal = $p->pivot->subtotal;
                break;
            }
        }

        $v->valor_total -= $subtotal;
        $v->produtos()->detach($id_produto);
        $v->save();

        return redirect()->route('cadastrar_venda_item', ["id" => $v->id]);
    }
}
