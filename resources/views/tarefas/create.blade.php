{{-- resources/views/tarefas/create.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                       <span>
                        @if(isset($tarefa))
                            Edição de Tarefa
                        @else
                            Cadastro de Tarefa
                        @endif
                       </span>
                        <a href="{{ route('tarefas.index') }}" class="btn btn-primary float-right">
                            Listar
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="@if(isset($tarefa)) {{ route('tarefas.update', $tarefa->id) }} @else {{ route('tarefas.store') }} @endif">
                            @csrf
                            @if(isset($tarefa))
                                @method('PUT')
                            @endif

                            <div class="form-group row mb-3">
                                <label for="titulo" class="col-md-4 col-form-label text-md-right">Título</label>

                                <div class="col-md-6">
                                    <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo', $tarefa->titulo ?? '') }}" required autocomplete="titulo" autofocus>

                                    @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="categoria" class="col-md-4 col-form-label text-md-right">Categoria</label>

                                <div class="col-md-6">
                                    <input id="categoria" type="text" class="form-control @error('categoria') is-invalid @enderror" name="categoria" value="{{ old('categoria', $tarefa->categoria ?? '') }}" required autocomplete="categoria">

                                    @error('categoria')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if(isset($tarefa))
                                            Atualizar
                                        @else
                                            Cadastrar
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection