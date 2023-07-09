<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class estadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([[
            'descripcion' => 'Pendiente',
            'user_id' => 1
        ],[
            'descripcion' => 'en curso',
            'user_id' => 1
        ],[
            'descripcion' => 'finalizado',
            'user_id' => 1
        ],
        [
            'descripcion' => 'eliminado',
            'user_id' => 1
        ]
    ]);
    }
}
