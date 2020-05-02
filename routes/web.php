<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect()->route('listar_vendas');
});

/* INDEX */
Route::get('/', 'AppController@index')->name('index');


/* Usuarios */
Route::get('/usuarios/listar', 'UsuarioController@telaListar')->name('listar_usuarios');

Route::get('/usuarios/cadastro', 'UsuarioController@telaCadastro')->name('cadastrar_usuarios');
Route::post('/usuarios/cadastro/efetua', 'UsuarioController@adicionar')->name('cadastrar_usuarios_efetua');

Route::get('/usuarios/alterar/{id}', 'UsuarioController@telaAlteracao')->name('alterar_usuarios');
Route::post('/usuarios/alterar/efetua/{id}', 'UsuarioController@alterar')->name('alterar_usuarios_efetua');

Route::get('/usuarios/excluir/{id}', 'UsuarioController@excluir')->name('excluir_usuarios');




/* Rotas para clientes */
Route::get('/clientes/listar', 'ClienteController@telaListar')->name("listar_clientes");

Route::get('/clientes/cadastro', 'ClienteController@telaCadastro')->name("cadastrar_clientes");
Route::post('/clientes/cadastro/efetua', 'ClienteController@adicionar')->name("cadastrar_clientes_efetua");

Route::get('/clientes/alterar/{id}', 'ClienteController@telaAlterar')->name("alterar_clientes");
Route::post('/clientes/alterar/efetua/{id}', 'ClienteController@alterar')->name("alterar_clientes_efetua");

Route::get('/clientes/excluir/{id}', 'ClienteController@excluir')->name("excluir_clientes");



/* Rotas para vendas */
Route::get('/vendas/listar', 'VendaController@telaListar')->name("listar_vendas");
Route::get('/vendas/listar/cliente/{id}', 'VendaController@telaListarVendasPorCliente')->name('vendas_cliente');

Route::get('/vendas/cadastro', 'VendaController@telaCadastro')->name("cadastrar_venda");
Route::post('/vendas/cadastro/efetua', 'VendaController@adicionar')->name("cadastrar_venda_efetua");

Route::get('/vendas/cadastro/{id}/item', 'VendaController@telaCadastroItem')->name("cadastrar_venda_item");
Route::post('/vendas/cadastro/{id}/item/efetua', 'VendaController@adicionarItem')->name("cadastrar_venda_item_efetua");

Route::get('/vendas/alterar/{id}', 'VendaController@telaAlterar')->name("alterar_vendas");
Route::post('/vendas/alterar/efetua/{id}', 'VendaController@alterar')->name("alterar_vendas_efetua");

Route::get('/vendas/excluir/{id}', 'VendaController@excluir')->name("excluir_vendas");
Route::get('/vendas/excluir/{id}/item/{id_produto}', 'VendaController@excluirItem')->name("excluir_vendas_item");



/* Rotas para tipos de produtos */
Route::get('/produtos/tipo/listar', 'TipoProdutosController@telaListar')->name("listar_tipo_produtos");

Route::get('/produtos/tipo/cadastro', 'TipoProdutosController@telaCadastro')->name("cadastrar_tipo_produtos");
Route::post('/produtos/tipo/cadastro/efetua', 'TipoProdutosController@adicionar')->name("cadastrar_tipo_produtos_efetua");

Route::get('/produtos/tipo/alterar/{id}', 'TipoProdutosController@telaAlterar')->name("alterar_tipo_produtos");
Route::post('/produtos/tipo/alterar/efetua/{id}', 'TipoProdutosController@alterar')->name("alterar_tipo_produtos_efetua");

Route::get('/produtos/tipo/excluir/{id}', 'TipoProdutosController@excluir')->name("excluir_tipo_produtos");




/* Rotas para tipos de produtos */
Route::get('/produtos/listar', 'ProdutosController@telaListar')->name("listar_produtos");

Route::get('/produtos/cadastro', 'ProdutosController@telaCadastro')->name("cadastrar_produtos");
Route::post('/produtos/cadastro/efetua', 'ProdutosController@adicionar')->name("cadastrar_produtos_efetua");

Route::get('/produtos/alterar/{id}', 'ProdutosController@telaAlterar')->name("alterar_produtos");
Route::post('/produtos/alterar/efetua/{id}', 'ProdutosController@alterar')->name("alterar_produtos_efetua");

Route::get('/produtos/excluir/{id}', 'ProdutosController@excluir')->name("excluir_produtos");




/* LOGIN */
Route::get('/tela_login', 'AppController@tela_login')->name('tela_login');
Route::get('/logout', 'AppController@logout')->name('logout');
Route::post('/login', 'AppController@login')->name('logar');