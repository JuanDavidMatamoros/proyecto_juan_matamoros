@extends('layouts.plantilla')

@section('titulo', 'Detalles del Equipo')

@section('contenido')

    <div class="container mt-4">

        <h1 class="fw-bold text-primary mb-4">Detalles del Equipo: {{ $equipo->nombre }}</h1>

        <div class="card shadow-sm">
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ $equipo->id }}</li>
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $equipo->nombre }}</li>
                    <li class="list-group-item"><strong>Ciudad:</strong> {{ $equipo->ciudad }}</li>
                    <li class="list-group-item"><strong>Categoría:</strong> {{ $equipo->categoria ?? 'No especificado' }}</li>
                    <li class="list-group-item"><strong>Año de fundación:</strong> {{ $equipo->fundado_en ?? 'No especificado' }}</li>
                    <li class="list-group-item">
                        <strong>Propietario:</strong> {{ $equipo->propietario?->name ?? 'Sin propietario' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Cantidad de jugadores:</strong> {{ $equipo->jugadores->count() }}
                    </li>
                    <li class="list-group-item"><strong>Fecha de creación:</strong> {{ $equipo->created_at->diffForHumans() }}</li>
                    <li class="list-group-item"><strong>Fecha de actualización:</strong> {{ $equipo->updated_at }}</li>
                </ul>

                <div class="mt-4 text-center">
                    <a href="{{ route('equipos.index') }}" class="btn btn-primary shadow-sm">
                        ← Volver a Equipos
                    </a>
                </div>

            </div>
        </div>

    </div>

@endsection


