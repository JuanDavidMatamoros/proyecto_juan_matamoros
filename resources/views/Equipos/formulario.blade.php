@extends('layouts.plantilla')

@section('titulo')
    @isset($equipo)
        Editar Equipo
    @else
        Crear Equipo
    @endisset
@endsection

@section('contenido')

    <h1>
        @isset($equipo)
            Editar
        @else
            Crear
        @endisset
        Equipo
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
            <form method="post" action="{{ isset($equipo) ? route('equipos.update', ['id' => $equipo->id]) : route('equipos.store') }}">
                @csrf
                @isset($equipo)
                    @method('put')
                @endisset

                {{-- Nombre --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del equipo"
                           value="{{ old('nombre', $equipo->nombre ?? '') }}">
                    <label for="nombre">Nombre del equipo</label>
                </div>

                {{-- Ciudad --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad"
                           value="{{ old('ciudad', $equipo->ciudad ?? '') }}">
                    <label for="ciudad">Ciudad</label>
                </div>

                {{-- Categoría --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoría"
                           value="{{ old('categoria', $equipo->categoria ?? '') }}">
                    <label for="categoria">Categoría</label>
                </div>

                {{-- Año de fundación --}}
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="fundado_en" name="fundado_en" placeholder="Año de Fundación"
                           value="{{ old('fundado_en', $equipo->fundado_en ?? '') }}">
                    <label for="fundado_en">Fundado en</label>
                </div>

                {{-- Propietario --}}
                <div class="form-floating mb-3">
                    <select class="form-select" id="propietario_id" name="propietario_id">
                        <option value="">Seleccione un propietario</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}"
                                {{ (old('propietario_id', $equipo->propietario_id ?? '') == $usuario->id) ? 'selected' : '' }}>
                                {{ $usuario->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="propietario_id">Propietario</label>
                </div>

                <input type="submit" value="Guardar" class="btn btn-primary">
                <input type="reset" value="Cancelar" class="btn btn-danger">
            </form>
        </div>
    </div>

@endsection
