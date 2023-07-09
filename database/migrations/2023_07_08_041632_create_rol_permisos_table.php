<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\rol;
use App\Models\permisos;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rol_permisos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(rol::class)->constrained();
            $table->foreignIdFor(permisos::class)->constrained();
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permisos');
    }
};
