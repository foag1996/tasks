<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all();
        return response()->json($tareas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_vencimiento' => 'required|date',
            'tarea_completada' => 'required|boolean',
        ]);

        $tarea = Tarea::create($request->all());
        return response()->json($tarea, 201);
    }

    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);
        return response()->json($tarea);
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $request->validate([
            'titulo' => 'string|max:255',
            'descripcion' => 'string',
            'fecha_vencimiento' => 'date',
            'tarea_completada' => 'boolean',
        ]);

        $tarea->update($request->all());
        return response()->json($tarea);
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return response()->json(null, 204);
    }
}
