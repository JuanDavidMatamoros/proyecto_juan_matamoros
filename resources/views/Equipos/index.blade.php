@extends('layouts.plantilla')
@section('titulo','Lista de Equipos')
@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Lista de Equipos</h1>

        <div class="mb-4">
            <form action="{{ route('equipos.index') }}" method="GET" class="d-flex align-items-center">
                <select name="propietario_id" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">-- Todos los propietarios --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ request('propietario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }}
                        </option>
                    @endforeach
                </select>

                @if(request('propietario_id'))
                    <a href="{{ route('equipos.index') }}" class="btn btn-secondary ms-2">Quitar filtro</a>
                @endif
            </form>
        </div>

        <div>
            <a class="btn btn-success me-2 shadow-sm" href="{{ route('equipos.create') }}">➕ Nuevo</a>

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary shadow-sm">Cerrar sesión</button>
            </form>
        </div>
    </div>

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Propietario</th>
                <th class="text-center">Jugadores</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($equipos as $equipo)
                <tr>
                    <td>
                        <a href="{{ route('equipos.show', ['id'=> $equipo->id]) }}" class="text-decoration-underline text-primary">
                            {{ $equipo->nombre }}
                        </a>
                    </td>
                    <td>{{ $equipo->ciudad }}</td>
                    <td>{{ $equipo->propietario?->name ?? 'Sin propietario' }}</td>
                    <td class="text-center">
                        <a href="{{ route('equipos.jugadores', ['id' => $equipo->id]) }}" class="fw-bold text-success">
                            {{ $equipo->jugadores->count() }}
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('equipos.edit', ['id' => $equipo->id]) }}" class="btn btn-warning btn-sm me-1 shadow-sm">Editar</a>

                        <button type="button" class="btn btn-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#eliminar_{{ $equipo->id }}">
                            Eliminar
                        </button>

                        <!-- Modal eliminar -->
                        <div class="modal fade" id="eliminar_{{ $equipo->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $equipo->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h1 class="modal-title fs-5" id="modalLabel{{ $equipo->id }}">Confirmar eliminación</h1>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Desea realmente eliminar el equipo <strong>{{ $equipo->nombre }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('equipos.destroy', ['id' => $equipo->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No hay equipos registrados</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="mt-4 text-center">
            <a href="{{ route('jugadores.index') }}" class="btn btn-purple shadow-sm" style="background-color: purple; color: white;">
                Ir a Jugadores
            </a>
        </div>
        <div>
            {{ $equipos->links() }}
        </div>
    </div>

@endsection


