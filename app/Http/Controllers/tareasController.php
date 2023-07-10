<?php

namespace App\Http\Controllers;

use App\Models\tarea;
use App\Models\proyecto;
use App\Models\User;
use App\Models\estados;
use App\Models\asignacion;
use Illuminate\Http\Request;
use App\Http\Resources\TareaResource;
use Validator;

class tareasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $tareas=TareaResource::collection(tarea::where('estados_id','<>',4)->get());
            return $this->sendResponse($tareas,'Consultado');;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'TITULO' => 'required',
            'DESCRIPCION' => 'required',
            'PROYECTO' => 'required',
            'USUARIO' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }

        $validarusuario=User::where('usuario',$request->USUARIO)->where('estado',1)->first();

        if(!$validarusuario){
            return $this->sendError('usuario invalido o inactivo'); 
        }

        $validarproyecto=proyecto::find($request->PROYECTO);

        if(!$validarproyecto){
            return $this->sendError('Proyecto invalido'); 
        }


        try{
        $tarea=tarea::create(
            [
                'titulo'=>$request->TITULO,
                'descripcion'=>$request->DESCRIPCION,
                'proyecto_id'=>$request->PROYECTO,
                'estados_id'=>1,
                'user_id'=>$validarusuario->id
            ]);

        return $this->sendResponse(new TareaResource($tarea), 'Nueva tarea registrada');
        }catch(\Exception $e){
            return $this->sendError('Error al intentar registrar nueva tarea'.$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tarea $tarea)
    {
        return $this->sendResponse(new TareaResource($tarea),'Consultado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tarea $tarea)
    {
        $validator = Validator::make($request->all(), [            
            'TITULO' => 'required',
            'DESCRIPCION' => 'required',
            'ESTADO'=>'required|integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }

        $validarestado=estados::find($request->ESTADO);

        if(!$validarestado){
            return $this->sendError('Estado Invalido'); 
        }

        try{
        $tarea->titulo=$request->TITULO;
        $tarea->descripcion=$request->DESCRIPCION;
        $tarea->estados_id=$request->ESTADO;
        $tarea->save();
        return $this->sendResponse(new TareaResource($tarea), 'Actualizacion exitosa');
        }catch(\Exception $e){
            return this->sendError('Error al intentar actualizar la informacion de la tarea');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tarea $tarea)
    {
        $tarea->estados_id=4;
        $tarea->save();
        return $this->sendResponse('', 'Registro eliminado con exito');
    }

    public function Asignartouser(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'TAREA' => 'required',
            'USUARIO' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }

        $validartarea=tarea::where('estados_id','<>',4)->find($request->TAREA);
        if(!$validartarea){
            return $this->sendError('tarea Invalida'); 
        }

        $validarusuario=User::where('usuario',$request->USUARIO)->where('estado',1)->first();

        if(!$validarusuario){
            return $this->sendError('usuario invalido o inactivo'); 
        }

        try {
          $asignar=asignacion::create(
            [
                'tarea_id'=>$request->TAREA,
                'user_id'=>$validarusuario->id,
            ]);

        return $this->sendResponse('', 'tarea asignada');
        }catch(\Exception $e){
            return $this->sendError('Error al intentar asignar una tarea'.$e);
        }
    }

    public function desasignartouser(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'TAREA' => 'required',
            'USUARIO' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error con los datos enviados', $validator->errors());       
        }

        $validarusuario=User::where('usuario',$request->USUARIO)->where('estado',1)->first();
        try{
        $asignar=asignacion::where('tarea_id',$request->TAREA)->where('user_id',$validarusuario->id)->first();
        $asignar->delete();
        return $this->sendResponse('', 'Tarea desasignada con exito');
        }catch(\Exception $e){
            return $this->sendError('Error al intentar desasignar una tarea'.$e);
        }
    }
}
