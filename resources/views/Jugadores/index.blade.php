@extends('layouts.plantilla')
@section('titulo','Lista de Jugadores')
@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Lista de Jugadores</h1>

        <div>
            <a class="btn btn-success me-2 shadow-sm" href="{{ route('jugadores.create') }}">➕ Nuevo</a>

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary shadow-sm">Cerrar sesión</button>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="mb-3">
            <form action="{{ route('jugadores.index') }}" method="GET" class="d-flex align-items-center">
                <select name="equipo_id" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">-- Todos los equipos --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ request('equipo_id') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>

                @if(request('equipo_id'))
                    <a href="{{ route('jugadores.index') }}" class="btn btn-secondary">Quitar filtro</a>
                @endif
            </form>
        </div>
    </div>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Atención:</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Posición</th>
                <th>Nacionalidad</th>
                <th>Número</th>
                <th>Equipo</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($jugadores as $jugador)
                <tr>
                    <td>
                        <a href="{{ route('jugadores.show', ['id' => $jugador->id]) }}"
                           class="text-primary text-decoration-underline fw-semibold">
                            {{ $jugador->nombre }}
                        </a>
                    </td>
                    <td>{{ $jugador->edad }}</td>
                    <td>{{ $jugador->posicion }}</td>
                    <td>{{ $jugador->nacionalidad }}</td>
                    <td>{{ $jugador->numero_camiseta }}</td>
                    <td>
                        @if($jugador->equipo)
                            <a href="{{ route('equipos.show', ['id' => $jugador->equipo->id]) }}"
                               class="text-success text-decoration-underline fw-semibold">
                                {{ $jugador->equipo->nombre }}
                            </a>
                        @else
                            <span class="text-muted">Sin equipo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('jugadores.edit', $jugador) }}" class="btn btn-warning btn-sm me-1 shadow-sm">
                            Editar
                        </a>

                        <button type="button" class="btn btn-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#eliminar_{{ $jugador->id }}">
                            Eliminar
                        </button>

                        <!-- Modal de confirmación -->
                        <div class="modal fade" id="eliminar_{{ $jugador->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $jugador->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h1 class="modal-title fs-5" id="modalLabel{{ $jugador->id }}">Eliminar jugador</h1>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Desea realmente eliminar al jugador <strong>{{ $jugador->nombre }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('jugadores.destroy', $jugador) }}" method="post" class="d-inline">
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
                    <td colspan="7" class="text-center text-muted">No hay jugadores registrados</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="mt-4 text-center">
            <a href="{{ route('equipos.index') }}" class="btn btn-purple shadow-sm" style="background-color: purple; color: white;">
                Ir a Equipos
            </a>
        </div>
        <div>
            {{ $jugadores->links() }}
        </div>
    </div>

@endsection


