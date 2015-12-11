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
            $newtorneo = new Torneo();
            $newtorneo->tipo = Input::get('tipo');
            $newtorneo->diainicio = Input::get('diainicio');
            $newtorneo->nrofechas = Input::get('nrofechas');
            $newtorneo->codcampeonato = Input::get('codcampeonato');
            $newtorneo->save();

            $respuesta['mensaje'] = 'Datos guardados correctamente';
            $respuesta['error'] = false;
        }
        return $respuesta;
    }
}