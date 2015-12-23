<?php
class Torneo extends Eloquent {

    protected $table = 'ttorneo';
    public $timestamps= false;
    protected $primaryKey='idtorneo';

    public static function crear($input)
    {
        $respuesta = [];
        $reglas =
            [
                'tipo'=>array('required'),
                'diainicio'=>array('required'),
                'nrofechas'=>array('required')
            ];
        $validador = Validator::make($input,$reglas);
        if($validador->fails()){
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            $torneo = Torneo::where('tipo','=',Input::get('tipo'))->where('codcampeonato','=',Input::get('codcampeonato'))->first();
            if($torneo == '')
            {
                //recuperamos la fecha ingresada y lo acomodamos para ingresar a la base de datos
                $fecha = Input::get('diainicio');
                $mes = substr($fecha,0,2);
                $dia = substr($fecha,3,2);
                $año = substr($fecha,6,4);
                $fecha = $año.'-'.$mes.'-'.$dia;
                //se crea un torneo
                $newtorneo = new Torneo();
                $newtorneo->tipo = Input::get('tipo');
                $newtorneo->diainicio = $fecha;
                $newtorneo->nrofechas = Input::get('nrofechas');
                $newtorneo->codcampeonato = Input::get('codcampeonato');
                $newtorneo->save();

                $respuesta['mensaje'] = 'Datos guardados correctamente';
                $respuesta['error'] = false;
            }
           else
           {
               $respuesta['mensaje'] = 'Este torneo ya existe';
               $respuesta['error'] = true;
           }
        }
        return $respuesta;
    }
}