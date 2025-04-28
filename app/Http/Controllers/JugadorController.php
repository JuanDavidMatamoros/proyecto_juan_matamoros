<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $equipos = \App\Models\Equipo::all(); // Traemos todos los equipos para el filtro

        $query = \App\Models\Jugador::query()->with('equipo'); // Jugadores con su equipo

        // Si el usuario seleccionó un equipo
        if ($request->filled('equipo_id')) {
            $query->where('equipo_id', $request->equipo_id);
        }

        $jugadores = $query->paginate(10);

        return view('jugadores.index', compact('jugadores', 'equipos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('jugadores.formulario', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'posicion' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'numero_camiseta' => 'nullable|integer|min:0',
            'equipo_id' => 'nullable|exists:equipos,id',
        ]);

        $jugador = new Jugador();
        $jugador->nombre = $request->nombre;
        $jugador->edad = $request->edad;
        $jugador->posicion = $request->posicion;
        $jugador->nacionalidad = $request->nacionalidad;
        $jugador->numero_camiseta = $request->numero_camiseta;
        $jugador->equipo_id = $request->equipo_id;
        $jugador->user_id = auth()->id();
        $jugador->save();

        return redirect()->route('jugadores.index')->with('status', 'Jugador creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jugador = Jugador::with('equipo')->findOrFail($id);
        return view('jugadores.show', compact('jugador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jugador = Jugador::findOrFail($id);
        $equipos = Equipo::all();
        return view('jugadores.formulario', compact('jugador', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'posicion' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'numero_camiseta' => 'nullable|integer|min:0',
            'equipo_id' => 'nullable|exists:equipos,id',
        ]);

        $jugador = Jugador::findOrFail($id);

        $jugador->nombre = $request->nombre;
        $jugador->edad = $request->edad;
        $jugador->posicion = $request->posicion;
        $jugador->nacionalidad = $request->nacionalidad;
        $jugador->numero_camiseta = $request->numero_camiseta;
        $jugador->equipo_id = $request->equipo_id;
        $jugador->save();

        return redirect()->route('jugadores.index')->with('status', 'Acción completada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jugador = Jugador::findOrFail($id);

        // Validar si el jugador tiene equipo
        if ($jugador->equipo_id !== null) {
            return redirect()->route('jugadores.index')
                ->with('status', 'No puedes eliminar el jugador porque está asociado a un equipo.');
        }

        // Si no tiene equipo, eliminarlo
        $jugador->delete();

        return redirect()->route('jugadores.index')->with('status', 'Acción completada correctamente.');
    }


}
