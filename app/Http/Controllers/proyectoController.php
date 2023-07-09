<?php

namespace App\Http\Controllers;

use App\Models\proyecto;
use Illuminate\Http\Request;
use App\Http\Resources\ProyectoResource;
use Validator;


class proyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return $this->sendResponse(new ProyectoResource::collection(proyecto::where('estado_id','<>',4)->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'TITULO' => 'required',
            'DESCRIPCION' => 'required',
            'INICIO' => 'required|date',
            'FIN' => 'required|date|after:INICIO',
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }

        try{
        $proyecto=proyecto::create(
            [
                'titulo'=>$request->TITULO,
                'descripcion'=>$request->DESCRIPCION,
                'fecha_inicio'=>$request->INICIO,
                'fecha_fin'=>$request->FIN,
                'estado'=>1
            ]);

        return $this->sendResponse(new ProyectoResource($proyecto), 'Nuevo proyecto registrado');
        }catch(\Exception $e){
            return $this->sendError('Error al intentar registrar nuevo proyecto');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(proyecto $proyecto)
    {
        return $this->sendResponse(new ProyectoResource::collection($proyecto));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, proyecto $proyecto)
    {

        $validator = Validator::make($request->all(), [            
            'TITULO' => 'required',
            'DESCRIPCION' => 'required',
            'INICIO' => 'required|date',
            'FIN' => 'required|date|after:INICIO',
            'ESTADO'=>'required|integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }
        try{
        $proyecto->titulo=$request->TITULO;
        $proyecto->descripcion=$request->DESCRIPCION;
        $proyecto->fecha_inicio=$request->INICIO;
        $proyecto->fecha_fin=$request->FIN;
        $proyecto->save();
        return $this->sendResponse(new ProyectoResource($proyecto), 'Actualizacion exitosa');
        }catch(\Exception $e){
            return this->sendError('Error al intentar actualizar la informacion del proyecto');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proyecto $proyecto)
    {
        $proyecto->destroy();
    }
}
