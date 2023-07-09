<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rols')->insert([[
            'nombre_rol'=>'administrador',
            'estado'=>1
        ],[
            'nombre_rol'=>'regular',
            'estado'=>1
        ]]);
    }
}
