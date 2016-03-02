<?php

class Comision extends Eloquent{
    protected $table = 'tcom_org';
    public $timestamps= false;
    protected $primaryKey = 'codCom_Org';
    
    public static function editar($idusuario,$input)
    {
        $respuesta = array();
        $reglas = [
            'usuario'=>array('required','min:3','max:20'),
            'password'=>array('required','min:5','max:30'),
            'password2'=>array('required','min:5','max:30'),
            'Comision'=>array('required'),
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
                        'tipo'=>'comision organizadora',
                        'estado'=>Input::get('estado')]);

                DB::table('tcom_org')
                    ->where('idUsuario',$idusuario)
                    ->update(['nombre'=> Input::get('Comision'),'idUsuario'=> $idusuario]);
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