<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\estados;

class ProyectoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $estado=estados::find($this->estados_id);
        return [
            'IDPROYECTO' => $this->id,
            'TITULO' => $this->titulo,
            'DESCRIPCION' => $this->descripcion,
            'INICIO' => $this->fecha_inicio,
            'FIN' => $this->fecha_fin,
            'ESTADO' => $estado->descripcion,
        ];
    }
}
