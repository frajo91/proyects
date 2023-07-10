<?php

namespace App\Http\Controllers;

use App\Models\proyecto;
use App\Models\User;
use App\Models\estados;
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
        $proyectos=ProyectoResource::collection(proyecto::where('estados_id','<>',4)->get());
            return $this->sendResponse($proyectos,'Consultado');;
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
            'USUARIO'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }

        $validarusuario=User::where('usuario',$request->USUARIO)->where('estado',1)->first();

        if(!$validarusuario){
            return $this->sendError('usuario invalido o inactivo', $validator->errors()); 
        }


        try{
        $proyecto=proyecto::create(
            [
                'titulo'=>$request->TITULO,
                'descripcion'=>$request->DESCRIPCION,
                'fecha_inicio'=>$request->INICIO,
                'fecha_fin'=>$request->FIN,
                'estados_id'=>1,
                'user_id'=>$validarusuario->id
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

        return $this->sendResponse(new ProyectoResource($proyecto),'Consultado');
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

        $validarestado=estados::find($request->ESTADO);

        if(!$validarestado){
            return $this->sendError('Estado Invalido', $validator->errors()); 
        }

        try{
        $proyecto->titulo=$request->TITULO;
        $proyecto->descripcion=$request->DESCRIPCION;
        $proyecto->fecha_inicio=$request->INICIO;
        $proyecto->fecha_fin=$request->FIN;
        $proyecto->estados_id=$request->ESTADO;
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

        $proyecto->estados_id=4;
        $proyecto->save();
        return $this->sendResponse('', 'Registro eliminado con exito');
    }
}
