<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\tarea;
use App\Models\estados;

class TareaResource extends JsonResource
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
            'IDTAREA' => $this->id,
            'TITULO' => $this->titulo,
            'DESCRIPCION' => $this->descripcion,
            'ESTADO' => $estado->descripcion,
            'PROYECTO' => $this->proyecto_id,

        ];
    }
}
