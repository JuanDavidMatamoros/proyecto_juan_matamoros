@extends('layouts.plantilla')

@section('titulo')
    @isset($jugador)
        Editar Jugador
    @else
        Crear Jugador
    @endisset
@endsection

@section('contenido')

    <h1>
        @isset($jugador)
            Editar
        @else
            Crear
        @endisset
        Jugador
    </h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-4">
            <form method="post" action="{{ isset($jugador) ? route('jugadores.update', ['id' => $jugador->id]) : route('jugadores.store') }}">
                @csrf
                @isset($jugador)
                    @method('put')
                @endisset

                {{-- Nombre --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del jugador"
                           value="{{ old('nombre', $jugador->nombre ?? '') }}">
                    <label for="nombre">Nombre del jugador</label>
                </div>

                {{-- Edad --}}
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad"
                           value="{{ old('edad', $jugador->edad ?? '') }}">
                    <label for="edad">Edad</label>
                </div>

                {{-- Posición --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="posicion" name="posicion" placeholder="Posición"
                           value="{{ old('posicion', $jugador->posicion ?? '') }}">
                    <label for="posicion">Posición</label>
                </div>

                {{-- Nacionalidad --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Nacionalidad"
                           value="{{ old('nacionalidad', $jugador->nacionalidad ?? '') }}">
                    <label for="nacionalidad">Nacionalidad</label>
                </div>

                {{-- Número de camiseta --}}
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="numero_camiseta" name="numero_camiseta" placeholder="Número de camiseta"
                           value="{{ old('numero_camiseta', $jugador->numero_camiseta ?? '') }}">
                    <label for="numero_camiseta">Número de camiseta</label>
                </div>

                {{-- Equipo --}}
                <div class="form-floating mb-3">
                    <select class="form-select" id="equipo_id" name="equipo_id">
                        <option value="">Sin equipo</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}"
                                {{ (old('equipo_id', $jugador->equipo_id ?? '') == $equipo->id) ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <label for="equipo_id">Equipo</label>
                </div>

                <input type="submit" value="Guardar" class="btn btn-primary">
                <input type="reset" value="Cancelar" class="btn btn-danger">
            </form>
        </div>
    </div>

@endsection
