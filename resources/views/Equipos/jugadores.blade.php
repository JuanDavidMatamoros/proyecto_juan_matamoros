@extends('layouts.plantilla')

@section('titulo', 'Jugadores del equipo')

@section('contenido')

    <div class="container mt-4">

        <h1 class="fw-bold text-primary mb-4">
            Jugadores de {{ $equipo->nombre }}
        </h1>

        <div class="mb-4 text-start">
            <a href="{{ route('equipos.index') }}" class="btn btn-primary shadow-sm">
                ← Volver a Equipos
            </a>
        </div>

        @if($jugadores->isEmpty())
            <div class="alert alert-warning text-center">
                Este equipo no tiene jugadores registrados.
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Posición</th>
                                <th>Nacionalidad</th>
                                <th>Número de camiseta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jugadores as $jugador)
                                <tr>
                                    <td>{{ $jugador->nombre }}</td>
                                    <td>{{ $jugador->edad }}</td>
                                    <td>{{ $jugador->posicion }}</td>
                                    <td>{{ $jugador->nacionalidad }}</td>
                                    <td>{{ $jugador->numero_camiseta }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection

