<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TarefasController;

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

Route::get("/home", [LoginController::class, "homeIndex"])->name("home");
Route::get("/", [LoginController::class, "homeIndex"])->name("home");

Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class,"login"])->name("loginPost");

Route::get("/registro", [LoginController::class,"registroIndex"])->name("registro");
Route::post("/registro", [LoginController::class,"registro"])->name("registroPost");

Route::get("/logout", [LoginController::class,"Desconectar"])->name("logout");

Route::get("/minhastarefas", [TarefasController::class,"mtIndex"])->name("mt");

Route::get("/criarLista", [TarefasController::class, "index"])->name("criaLista");
Route::post("/criarLista", [TarefasController::class,"listaPost"])->name("listaPost");

Route::get("/tarefa/{id}", [TarefasController::class,"tarefaIndex"])->name("tarefas");
Route::post("/tarefa/{id}",[TarefasController::class,"tarefasPost"])->name("tarefaPost");
Route::put("/tarefa/{id}", [TarefasController::class,"listaAlter"])->name("listaAlter");
Route::delete("/tarefa/{id}", [TarefasController::class, "listaEx"])->name("listaEx");

Route::put("/tarefa/{id}/{tarefa_id}", [TarefasController::class,"tarefaAlter"])->name("tarefaAlter");
Route::delete("/tarefa/{id}/{tarefa_id}", [TarefasController::class, "tarefaEx"])->name("tarefaEx");