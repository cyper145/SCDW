<?php

class Arbitro extends Eloquent {

		protected $table = 'tarbitro';
		public $timestamps= false;
    protected $primaryKey = 'dni';

    public static function isertar($input)
    {
        $respuesta = [];
        $reglas = [
            'dni'=>array('required','min:8','max:8'),
            'nombre'=>array('required'),
            'apellidos'=>array('required'),
            'edad'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails())
        {
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            $newarbitro = new Arbitro();
            $newarbitro->dni = Input::get('dni');
            $newarbitro->nombre = Input::get('nombre');
            $newarbitro->Apellidos = Input::get('apellidos');
            $newarbitro->edad = Input::get('edad');
            $newarbitro->save();
            $respuesta['mensaje'] = 'Datos insertados correctamente';
            $respuesta['error'] = false;
        }
        return $respuesta;
    }

    public static function editar($dni,$input)
    {
        $respuesta = [];
        $reglas = [
            'dni'=>array('required','min:8','max:8'),
            'nombre'=>array('required'),
            'apellidos'=>array('required'),
            'edad'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails())
        {
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            Arbitro::where('dni','=',$dni)->update([''=>'']);
            $respuesta['mensaje'] = 'Datos no Actualizados';
            $respuesta['error'] = true;
        }
        return $respuesta;
    }
}