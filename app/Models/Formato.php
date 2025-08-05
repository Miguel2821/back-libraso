<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Libro;

class Formato extends Model
{
    public function libros() {
        return $this->hasMany(Libro::class);
    }

}
