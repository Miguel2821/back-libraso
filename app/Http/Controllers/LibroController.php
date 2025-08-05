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
            'autor' => 'required|string|max:255',
            'idioma' => 'required|string|max:100',
            'formato_id' => 'required|exists:formatos,id',
            'estado_id' => 'required|exists:estados,id',
            'generos' => 'required|array|min:1',
            'generos.*' => 'exists:generos,id',
            'numero_paginas' => 'required|integer|min:1|max:99999',
            'pagina_actual' => 'required|integer|min:0|max:'.$request->numero_paginas,
            'valoracion' => 'required|integer|min:1|max:5',
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
            'autor' => 'required|string|max:255',
            'idioma' => 'required|string|max:100',
            'formato_id' => 'required|exists:formatos,id',
            'estado_id' => 'required|exists:estados,id',
            'generos' => 'required|array|min:1',
            'generos.*' => 'exists:generos,id',
            'numero_paginas' => 'required|integer|min:1|max:99999',
            'pagina_actual' => 'required|integer|min:0|max:'.$request->numero_paginas,
            'valoracion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
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
    public function destroy($id)
        {
            $libro = Libro::where('user_id', auth()->id())->find($id);

            if (!$libro) {
                return response()->json(['message' => 'Libro no encontrado o no autorizado'], 404);
            }

            $libro->delete();

            return response()->json(['message' => 'Libro eliminado correctamente']);
        }


}
