<?php

class Equipo extends Eloquent{
    protected $table = 'tequipo';
    public $timestamps= false;
    protected $primaryKey = 'codEquipo';
    
    public static function editar($idusuario,$input)
    {
        $respuesta = array();
        $reglas = [
            'usuario'=>array('required','min:3','max:20'),
            'password'=>array('required','min:5','max:30'),
            'password2'=>array('required','min:5','max:30'),
            'Equipo'=>array('required'),
            'estado'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails()){
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            $password1 = Input::get('password');
            $password2 = Input::get('password2');
            if($password1 == $password2)
            {                    
                DB::table('tusuarios')
                    ->where('idUsuario',$idusuario)
                    ->update([
                        'username'=> Input::get('usuario'),
                        'password'=> Hash::make(Input::get('password')),
                        'tipo'=>'equipo',
                        'estado'=>Input::get('estado')]);

                DB::table('tequipo')
                    ->where('idUsuario',$idusuario)
                    ->update(['nombre'=> Input::get('Equipo'),'idUsuario'=> $idusuario]);
                $respuesta['mensaje'] = 'Datos Actualizados';
                $respuesta['error'] = false;
            }
            else
            {
                $respuesta['mensaje'] = 'Las contraseñas no coinsiden';
                $respuesta['error'] = true;
            }
        }
        return $respuesta;
    }
}