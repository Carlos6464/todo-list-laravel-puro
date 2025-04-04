@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Tarefas</h5>
                </div>

                <div class="card-body">
                    <div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <form action="{{ route('tarefas.index') }}" method="GET" class="d-flex gap-2">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Buscar tarefas..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-secondary">
                                    Buscar
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('tarefas.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nova Tarefa
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tarefas as $tarefa)
                                    <tr>
                                        <td>{{ $tarefa->id }}</td>
                                        <td>{{ $tarefa->titulo }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $tarefa->categoria }}</span>
                                        </td>
                                        <td>
                                            @if($tarefa->concluida)
                                                <span class="badge bg-success">Concluída</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pendente</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>

                                          
                                          
                                            <form id="delete-form-{{ $tarefa->id }}" action="{{ route('excluir', $tarefa->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmarExclusao({{ $tarefa->id }})">
                                                <i class="fas fa-trash"></i> Excluir
                                            </button>

                                           

                                            @if(!$tarefa->concluida)
                                                <form id="concluir-form-{{ $tarefa->id }}" action="{{ route('concluida', $tarefa->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>

                                                <button type="button" class="btn btn-sm btn-success" onclick="confirmarConclusao({{ $tarefa->id }})">
                                                    <i class="fas fa-check-circle"></i> Finalizar
                                                </button>
                                            @endif
                                           
                                        </td>
                                       
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhuma tarefa encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($tarefas->hasPages())
                        <div class="mt-4">
                            {{ $tarefas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmarExclusao(id) {
        Swal.fire({
            title: "Tem certeza?",
            text: "Essa ação não pode ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    function confirmarConclusao(id) {
        Swal.fire({
            title: "Tem certeza?",
            text: "Essa ação não pode ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#199c1b",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Sim, Finalizar!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('concluir-form-' + id).submit();
            }
        });
    }
</script>
@endsection
