@extends('layouts.plantilla')

@section('titulo', 'Detalles del Jugador')

@section('contenido')

    <div class="container mt-4">

        <h1 class="fw-bold text-primary mb-4">
            Detalles del Jugador: {{ $jugador->nombre }}
        </h1>

        <div class="card shadow-sm">
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ $jugador->id }}</li>
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $jugador->nombre }}</li>
                    <li class="list-group-item"><strong>Edad:</strong> {{ $jugador->edad }}</li>
                    <li class="list-group-item"><strong>Posición:</strong> {{ $jugador->posicion }}</li>
                    <li class="list-group-item"><strong>Nacionalidad:</strong> {{ $jugador->nacionalidad }}</li>
                    <li class="list-group-item"><strong>Número de camiseta:</strong> {{ $jugador->numero_camiseta }}</li>
                    <li class="list-group-item"><strong>Equipo:</strong>
                        @if($jugador->equipo)
                            <a href="{{ route('equipos.show', ['id' => $jugador->equipo->id]) }}" class="text-success fw-semibold">
                                {{ $jugador->equipo->nombre }}
                            </a>
                        @else
                            <span class="text-muted">Sin equipo</span>
                        @endif
                    </li>
                </ul>

                <div class="mt-4 text-center">
                    <a href="{{ route('jugadores.index') }}" class="btn btn-primary shadow-sm">
                        ← Volver a Jugadores
                    </a>
                </div>

            </div>
        </div>

    </div>

@endsection

