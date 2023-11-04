<?php

use App\Http\Controllers\FriendshipsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return redirect()->route('login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/filtrar-usuarios', [UserController::class, 'index'])->name('filtrar_usuarios');


Route::match(['get', 'post'], '/perfil-usuarios', [perfilController::class, 'index'])->name('perfil_usuarios');
Route::post('/perfil', [perfilController::class, 'store'])->name('perfil.store');

Route::post('/friendship', [FriendshipsController::class, 'store'])->name('friendships.store');


Route::post('/postagens', [HomeController::class, 'store'])->name('postagens.store');
Route::get('/postagens/criar', [PostsController::class, 'create'])->name('postagens.create');
Route::get('/postagem/{posts}', [PostsController::class, 'show'])->name('postagem.show');
Route::delete('/postagem/{id}', [PostsController::class, 'destroy'])->name('postagem.destroy');
Route::get('/postagem/{id}/edit' , [PostsController::class, 'edit'])->name('postagem.edit');
Route::put('/postagem/{id}', [PostsController::class, 'update'])->name('postagens.update');









