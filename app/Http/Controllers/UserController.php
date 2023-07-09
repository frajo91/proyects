<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Validator;

class UserController extends Controller
{
    
    public function login(Request $request){
        if(Auth::attempt(['usuario' => $request->usuario, 'password' => $request->contrasena, 'estado'=>1])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('proyecto')->plainTextToken; 
            $success['usuario'] =  $user->nombre.' '.$user->apellido;
            return $this->sendResponse($success, 'Inicio de sesión correcto');
        } 
        else{ 
            return $this->sendError('No autorizado', ['error'=>'No autorizado']);
        } 
    }

    public function registro(Request $request)
    {
       $validator = Validator::make($request->all(), [            
            'usuario' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'rol_id'=>'required',
            'contrasena' => 'required',
            'c_contrasena' => 'required|same:contrasena',
        ]);

   

        if($validator->fails()){
            return $this->sendError('Error de validación', $validator->errors());       
        }

        try{
   
        $input = $request->all();
        $input['contrasena'] = bcrypt($input['contrasena']);
        $input['estado']=1; 
        $user = User::create($input);
        $success['token'] =  $user->createToken('Proyects')->plainTextToken;
        $success['name'] =  $user->name;   

        return $this->sendResponse($success, 'Usuario registrado con exito');
        }catch(\Exception $e){
         return $this->sendError('No fue posible registrar el nuevo usuario, por favor valide la información');   
        }
       
    }
}
