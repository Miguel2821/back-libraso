<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    foreach ([
        ['nombre' => 'Fantasía'],
        ['nombre' => 'Ciencia Ficción'],
        ['nombre' => 'Romance'],
        ['nombre' => 'Historia'],
    ] as $genero) {
        DB::table('generos')->updateOrInsert(['nombre' => $genero['nombre']], $genero);
    }

    foreach ([
        ['nombre' => 'Físico'],
        ['nombre' => 'eBook'],
        ['nombre' => 'Audiolibro'],
    ] as $formato) {
        DB::table('formatos')->updateOrInsert(['nombre' => $formato['nombre']], $formato);
    }

    foreach ([
        ['nombre' => 'Pendiente'],
        ['nombre' => 'Leyendo'],
        ['nombre' => 'Leído'],
    ] as $estado) {
        DB::table('estados')->updateOrInsert(['nombre' => $estado['nombre']], $estado);
    }
}

}
