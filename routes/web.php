<?php

use App\Http\Controllers\LojasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PedidosConfirmadosController;
use App\Http\Controllers\PrecosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //TELA EXCLUIR USUARIO
    Route::get('excluirUsuario', [UsuarioController::class, 'create'])->name('excluirUsuario');
    Route::post('excluirUsuario', [UsuarioController::class, 'destroy']);

    //TELA CADASTRAR PEDIDO
    Route::get('cadastrarPedido', [PedidosController::class, 'index'])->name('cadastrarPedido');
    Route::post('cadastrarPedido', [PedidosController::class, 'create'])->name('cadastrarPedido');;


    //TELA CADASTRAR PRODUTO
    Route::get('cadastrarProduto', [ProdutosController::class, 'index'])->name('cadastrarProduto');
    Route::post('cadastrarProduto', [ProdutosController::class, 'create'])->name('cadastrarProduto');

    //TELA EDITAR PRODUTO
    Route::get('editarProduto', [ProdutosController::class, 'indexEditar'])->name('editarProduto');
    Route::post('listarinfoProduto', [ProdutosController::class, 'info'])->name('listarinfoProduto');
    Route::post('editarProduto', [ProdutosController::class, 'update'])->name('editarProduto');
    Route::post('excluirProduto', [ProdutosController::class, 'delete'])->name('excluirProduto');

    //LOJAS
    Route::get('lojas', [LojasController::class, 'index'])->name('lojas');
    Route::post('criarLoja', [LojasController::class, 'create'])->name('criarLoja');
    Route::post('listaLoja', [LojasController::class, 'listarLoja'])->name('listaLoja');
    Route::post('editaLoja', [LojasController::class, 'update'])->name('editaLoja');
    Route::post('excluirLoja', [LojasController::class, 'delete'])->name('excluirLoja');

    //LISTAGEM DE PEDIDOS
    Route::get('ListagemPedidos', [PedidosController::class, 'listagemPedidos'])->name('ListagemPedidos');
    Route::post('listarPedido', [PedidosController::class, 'listarPedido'])->name('listarPedido');

    //PEDIDOS POS COMPRA
    Route::get('pedidosPosCompra', [PedidosController::class, 'pedidosPosCompra'])->name('pedidosPosCompra');
    Route::post('cadastrarPedidosPosCompra', [PedidosController::class, 'cadastrarPedidosPosCompra'])->name('cadastrarPedidosPosCompra');
    Route::post('inserirValores', [PedidosController::class, 'inserirValores'])->name('inserirValores');
    route::post('listarPedidoPosCompra', [PedidosController::class, 'listarPedidoPosCompra'])->name('listarPedidoPosCompra');
    route::post('inserirValores', [PedidosController::class, 'inserirValores'])->name('inserirValores');
    route::post('incluirProduto', [PedidosController::class, 'incluirProduto'])->name('incluirProduto');
    
    //CADASTRO PRECOS
    Route::get('precos', [PrecosController::class, 'index'])->name('precos');
    Route::post('cadastrarPrecos', [PrecosController::class, 'cadastrarPrecos'])->name('cadastrarPrecos');
  
    //EDICAO DE PRECOS
    Route::get('editarPrecos', [PrecosController::class, 'editarPrecos'])->name('editarPrecos');
    Route::post('listarinfoPreco', [PrecosController::class, 'listarinfoPreco'])->name('listarinfoPreco');
    Route::post('listarEditarPrecos', [PrecosController::class, 'listarEditarPrecos'])->name('listarEditarPrecos');
    Route::post('editarPrecoProduto', [PrecosController::class, 'editarPrecoProduto'])->name('editarPrecoProduto');

    //LISTAGEM PEDIDOS CONFIRMADOS
    Route::get('pedidosConfirmados', [PedidosConfirmadosController::class, 'index'])->name('pedidosConfirmados');
    Route::post('listarPedidosConfirmados', [PedidosConfirmadosController::class, 'listarPedidosConfirmados'])->name('listarPedidosConfirmados');
});

require __DIR__.'/auth.php';
