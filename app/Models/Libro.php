<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Genero;
use App\Models\Formato;
use App\Models\Estado;

class Libro extends Model
{
    protected $fillable = [
    'titulo',
    'autor',
    'idioma',
    'genero_id',
    'formato_id',
    'estado_id',
    'numero_paginas',
    'pagina_actual',
    'valoracion',
    'comentario',
    'fecha_lectura',
];

public function generos() {
    return $this->belongsToMany(Genero::class);
}
public function formato() {
    return $this->belongsTo(Formato::class);
}
public function estado() {
    return $this->belongsTo(Estado::class);
}
public function user() {
    return $this->belongsTo(User::class);
}

}
