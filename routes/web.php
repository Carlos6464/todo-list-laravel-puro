<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefasController;



Route::get('/', [TarefasController::class, 'index'])->name('tarefas.index');

Route::get('/tarefa', [TarefasController::class, 'create'])->name('tarefas.create');

Route::post('/tarefa/salvar', [TarefasController::class, 'store'])->name('tarefas.store');

Route::get('/tarefa/{id}/editar', [TarefasController::class, 'edit'])->name('tarefas.edit');

Route::put('/tarefa/{id}', [TarefasController::class, 'update'])->name('tarefas.update');

Route::delete('/exlcuir/{id}', [TarefasController::class, 'destroy'])->name('excluir');

Route::put('/tarefa/concluida/{id}', [TarefasController::class, 'concluida'])->name('concluida');


