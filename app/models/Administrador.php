<?php

class Administrador extends Eloquent{
    protected $table = 'tadministrador';
    public $timestamps= false;
    protected $primaryKey='idAdministrador';
    
    public static function editar($idusuario,$input){
        $respuesta = array();
        $reglas = [
            'usuario'=>array('required','min:3','max:20'),
            'password'=>array('required','min:5','max:30'),
            'password2'=>array('required','min:5','max:30'),
            'docente'=>array('required'),
            'estado'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails()){
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else{
            $iddocente = substr(Input::get('docente'), 0,6);
            if($docente = Docente::where('codDocente', '=' , $iddocente)->first()){
                $password1 = Input::get('password');
                $password2 = Input::get('password2');
                if($password1 == $password2){                    
                    DB::table('tusuarios')
                        ->where('idUsuario',$idusuario)
                        ->update([
                            'username'=> Input::get('usuario'),
                            'password'=> Hash::make(Input::get('password')),
                            'tipo'=>'administrador',
                            'estado'=>Input::get('estado')]);
                    
                    DB::table('tadministrador')
                        ->where('idUsuario',$idusuario)
                        ->update(['codDocente'=> $iddocente,'idUsuario'=> $idusuario]);
                    $respuesta['mensaje'] = 'Datos Actualizados';
                    $respuesta['error'] = false;
                }
                else
                {
                    $respuesta['mensaje'] = 'Las contraseñas no coinsiden';
                    $respuesta['error'] = true;
                }
            }
            else{
                $respuesta['mensaje'] = "el docente que ingreso no existe";
                $respuesta['error'] = true;
            }
        }
        return $respuesta;
    }
    
    public static function eliminar($idusuario)
    {
        $respuesta = [];        
        if($usuario = User::where('idusuario' ,'=' , $idusuario)->first())
        {
            DB::table('tusuarios')
                ->where('idusuario',$idusuario)
                ->update([
                    'username'=> $usuario->username,
                    'password'=> $usuario->password,
                    'tipo'=>$usuario->tipo,
                    'estado'=>"bloqueado"]);
            $respuesta['mensaje'] = 'Usuario Bloqueado';
            $respuesta['error'] = false;
                    
        }
        else
        {
            $respuesta['mensaje'] = 'Usuario no se pudo eliminar';
            $respuesta['error'] = True;
        }
    }
}