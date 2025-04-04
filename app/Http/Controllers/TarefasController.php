<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefasController extends Controller
{
    public function index() {
       $tarefas = Tarefa::query()->when(request()->has('search'), function ($query) {
            $query->where('titulo', 'like', '%' . request('search') . '%');
        })->paginate(10);

       return view ('tarefas.index', ['tarefas' => $tarefas]);
    }

    public function create() {
        return view('tarefas.create');
    }

    public function store(Request $request) {
        Tarefa::create($request->all());
    
        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit($id) {
       
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefas.create', ['tarefa' => $tarefa]);
    }

    public function update(Request $request, $id) {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizado com sucesso!');
    }   

    public function destroy($id) {
        Tarefa::findOrFail($id)->delete();
        return redirect()->route('tarefas.index')->with('success', 'Tarefa excluida com sucesso!');
    }

    public function concluida($id) {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->concluida = !$tarefa->concluida;
        $tarefa->save();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa concluida com sucesso!');
    }
}
