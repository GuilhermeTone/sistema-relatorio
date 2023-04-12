<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PedidosController;
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

    Route::get('excluirUsuario', [UsuarioController::class, 'create'])->name('excluirUsuario');
    Route::post('excluirUsuario', [UsuarioController::class, 'destroy']);

    Route::get('cadastrarPedido', [PedidosController::class, 'index'])->name('cadastrarPedido');
    Route::post('cadastrarPedido', [PedidosController::class, 'create'])->name('cadastrarPedido');;

    Route::get('cadastrarProduto', [ProdutosController::class, 'index'])->name('cadastrarProduto');
    Route::post('cadastrarProduto', [ProdutosController::class, 'create'])->name('cadastrarProduto');

    Route::get('editarProduto', [ProdutosController::class, 'indexEditar'])->name('editarProduto');
    Route::post('listarinfoProduto', [ProdutosController::class, 'info'])->name('listarinfoProduto');
    Route::post('editarProduto', [ProdutosController::class, 'update'])->name('editarProduto');
});

require __DIR__.'/auth.php';
