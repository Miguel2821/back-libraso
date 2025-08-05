<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Formato;
use App\Models\Estado;

class CatalogoController extends Controller
{
    public function index()
    {
        return response()->json([
            'generos' => Genero::all(),
            'formatos' => Formato::all(),
            'estados' => Estado::all(),
        ]);
    }
}
