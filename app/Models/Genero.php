<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Libro;

class Genero extends Model
{
    public function libros() {
        return $this->belongsToMany(Libro::class);
}

}
