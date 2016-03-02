<?php
class Torneo extends Eloquent {

    protected $table = 'trueda';
    public $timestamps= false;
    protected $primaryKey='codRueda';

    public static function crear($input)
    {
        $respuesta = [];
        $reglas =
            [
                'tipo'=>array('required'),
                'diainicio'=>array('required'),

            ];
        $validador = Validator::make($input,$reglas);
        if($validador->fails()){
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            $torneo = Torneo::where('nombre','=',Input::get('tipo'))->where('codCampeonato','=',Input::get('codcampeonato'))->first();
            if($torneo == '')
            {
                //recuperamos la fecha ingresada y lo acomodamos para ingresar a la base de datos
                $fecha = Input::get('diainicio');
                $mes = substr($fecha,0,2);
                $dia = substr($fecha,3,2);
                $año = substr($fecha,6,4);
                $fecha = $año.'-'.$mes.'-'.$dia;
                //se crea un torneo
                $codCampeonato=Input::get('codcampeonato');
                $users = DB::table('trueda')->count();
                $users++;
                $users1=(int)substr($codCampeonato,3,strlen($codCampeonato));
                $codconclusion="TORO".$users1.$users;
                $input = Input::all();
                $newtorneo = new Torneo();
                $newtorneo->codRueda=$codconclusion;
                $newtorneo->nombre = Input::get('tipo');
                $newtorneo->fechaCreacion= $fecha;
                $newtorneo->codCampeonato = $codCampeonato;
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