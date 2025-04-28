<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $equipos = Equipo::with(['propietario', 'jugadores']);

        // Agregamos el filtro si se seleccionó un propietario
        if ($request->filled('propietario_id')) {
            $equipos->where('propietario_id', $request->propietario_id);
        }

        $equipos = $equipos->paginate(10); // paginar después de aplicar filtros

        $usuarios = User::all(); // Para llenar el select de propietarios

        return view('equipos.index', compact('equipos', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        return view('equipos.formulario', compact('usuarios'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'fundado_en' => 'nullable|integer|min:1800|max:' . date('Y'),
            'propietario_id' => 'nullable|exists:users,id',
        ]);

        $equipo = new \App\Models\Equipo();
        $equipo->nombre = $request->nombre;
        $equipo->ciudad = $request->ciudad;
        $equipo->categoria = $request->categoria;
        $equipo->fundado_en = $request->fundado_en;
        $equipo->user_id = auth()->id();
        $equipo->propietario_id = $request->propietario_id;
        $equipo->save();

        return redirect()->route('equipos.index')->with('status', 'Equipo creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipo = Equipo::findOrFail($id);
        $usuarios = User::all();
        return view('equipos.formulario', compact('equipo', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'fundado_en' => 'nullable|integer|min:1800|max:' . date('Y'), // Opcional: validamos año realista
            'propietario_id' => 'nullable|exists:users,id',
        ]);

        $equipo = Equipo::findOrFail($id);

        if (auth()->user()->email !== 'test@example.com' && $equipo->user_id !== auth()->id()) {
            return redirect()->route('equipos.index')->with('status', 'No tienes permiso para editar o eliminar este equipo.');
        }

        $equipo->nombre = $request->nombre;
        $equipo->ciudad = $request->ciudad;
        $equipo->categoria = $request->categoria;
        $equipo->fundado_en = $request->fundado_en;
        $equipo->propietario_id = $request->propietario_id;
        $equipo->save();

        return redirect()->route('equipos.index')->with('status', 'Equipo actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo = Equipo::findOrFail($id);

        // Validar que el equipo le pertenezca al usuario autenticado
        if (auth()->user()->email !== 'test@example.com' && $equipo->user_id !== auth()->id()) {
            return redirect()->route('equipos.index')->with('status', 'No tienes permiso para editar o eliminar este equipo.');
        }


        // Dejar jugadores sin equipo antes de eliminar
        foreach ($equipo->jugadores as $jugador) {
            $jugador->equipo_id = null;
            $jugador->save();
        }

        $equipo->delete();

        return redirect()->route('equipos.index')->with('status', 'Equipo eliminado correctamente.');
    }

    public function jugadores($id)
    {
        $equipo = \App\Models\Equipo::with('jugadores')->findOrFail($id);
        $jugadores = $equipo->jugadores; // Sacamos sus jugadores

        return view('equipos.jugadores', compact('equipo', 'jugadores'));
    }

}

