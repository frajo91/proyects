<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permisos')->insert([[
            'nombre_permiso'=>'crear proyecto',
            'estado'=>1
        ],[
            'nombre_permiso'=>'editar proyecto',
            'estado'=>1
        ],[
            'nombre_permiso'=>'eliminar proyecto',
            'estado'=>1
        ],[
            'nombre_permiso'=>'crear tarea',
            'estado'=>1
        ],[
            'nombre_permiso'=>'editar tarea',
            'estado'=>1
        ],[
            'nombre_permiso'=>'eliminar tarea',
            'estado'=>1
        ],[
            'nombre_permiso'=>'gestionar proyecto',
            'estado'=>1
        ],
        [
            'nombre_permiso'=>'gestionar tarea',
            'estado'=>1
        ]]);
    }
}
