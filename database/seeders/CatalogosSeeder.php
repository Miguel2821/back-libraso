<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Géneros
        foreach ([
            ['nombre' => 'Fantasía'],
            ['nombre' => 'Ciencia Ficción'],
            ['nombre' => 'Romance'],
            ['nombre' => 'Historia'],
            ['nombre' => 'Misterio'],
            ['nombre' => 'Aventura'],
            ['nombre' => 'No Ficción'],
        ] as $genero) {
            DB::table('generos')->updateOrInsert(
                ['nombre' => $genero['nombre']], 
                $genero
            );
        }

        // Formatos
        foreach ([
            ['nombre' => 'Físico'],
            ['nombre' => 'eBook'],
            ['nombre' => 'Audiolibro'],
        ] as $formato) {
            DB::table('formatos')->updateOrInsert(
                ['nombre' => $formato['nombre']], 
                $formato
            );
        }

        // Estados
        foreach ([
            ['nombre' => 'Pendiente'],
            ['nombre' => 'Leyendo'],
            ['nombre' => 'Leído'],
        ] as $estado) {
            DB::table('estados')->updateOrInsert(
                ['nombre' => $estado['nombre']], 
                $estado
            );
        }
    }
}
