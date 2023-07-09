<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rol_permisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol_permisos')->insert([[
            'rol_id'=>1,
            'permisos_id'=>1,
            'estado'=>1
        ],
    [
            'rol_id'=>1,
            'permisos_id'=>2,
            'estado'=>1
        ],[
            'rol_id'=>1,
            'permisos_id'=>3,
            'estado'=>1
        ],[
            'rol_id'=>1,
            'permisos_id'=>4,
            'estado'=>1
        ],[
            'rol_id'=>1,
            'permisos_id'=>5,
            'estado'=>1
        ],[
            'rol_id'=>1,
            'permisos_id'=>6,
            'estado'=>1
        ],[
            'rol_id'=>1,
            'permisos_id'=>7,
            'estado'=>1
        ],[
            'rol_id'=>1,
            'permisos_id'=>8,
            'estado'=>1
        ],[
            'rol_id'=>2,
            'permisos_id'=>7,
            'estado'=>1
        ],[
            'rol_id'=>2,
            'permisos_id'=>8,
            'estado'=>1
        ]]);
    }
}
