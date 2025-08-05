<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'nullable|string',
            'idioma' => 'nullable|string',
            'formato_id' => 'required|exists:formatos,id',
            'estado_id' => 'required|exists:estados,id',
            'generos' => 'required|array',
            'generos.*' => 'exists:generos,id',
            'numero_paginas' => 'nullable|string|max:5',
            'pagina_actual' => 'nullable|string|max:5',
            'valoracion' => 'nullable|string',
            'comentario' => 'nullable|string',
            'fecha_lectura' => 'nullable|date',
        ]);

        $libro = $request->user()->libros()->create($validated);

        // Relacionar géneros
        $libro->generos()->sync($request->generos);

        return response()->json([
            'message' => 'Libro guardado correctamente',
            'libro' => $libro->load('generos', 'formato', 'estado')
        ]);
    }
    public function index(Request $request)
    {
        $user = $request->user();

        $libros = $user->libros()->with(['generos', 'formato', 'estado'])->get();

        return response()->json($libros);
    }
    public function update(Request $request, $id)
    {
        $libro = $request->user()->libros()->findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'nullable|string',
            'idioma' => 'nullable|string',
            'formato_id' => 'required|exists:formatos,id',
            'estado_id' => 'required|exists:estados,id',
            'generos' => 'required|array',
            'generos.*' => 'exists:generos,id',
            'numero_paginas' => 'nullable|string|max:5',
            'pagina_actual' => 'nullable|string|max:5',
            'valoracion' => 'nullable|string',
            'comentario' => 'nullable|string|max:5000', // o el límite que quieras
            'fecha_lectura' => 'nullable|date',
        ]);

        $libro->update($validated);

        // Sincronizar géneros
        $libro->generos()->sync($validated['generos']);

        return response()->json([
            'message' => 'Libro actualizado correctamente',
            'libro' => $libro->load('generos', 'formato', 'estado'),
        ]);
    }

}
