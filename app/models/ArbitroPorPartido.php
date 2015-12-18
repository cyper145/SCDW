<?php

class ArbitroPorPartido extends Eloquent
{
    protected $table = 'tarbitroxpartido';
    public $timestamps= false;
    protected $primaryKey = 'idarbitroporpartido';
    protected $fillable = ['idarbitroporpartido','principal','asistente1','asistente2'];

    public function DataArbitroPrincipal()
    {
        return $this -> hasMany("Arbitro",'dni','principal');
    }

    public function DataArbitroAsistente1()
    {
        return $this -> hasMany("Arbitro",'dni','asistente1');
    }

    public function DataArbitroAsistente2()
    {
        return $this -> hasMany("Arbitro",'dni','asistente2');
    }

    public static function isertar($input)
    {
        $respuesta = [];
        $reglas = [
            'principal'=>array('required'),
            'asistente1'=>array('required'),
            'asistente2'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails())
        {
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            $prin = Input::get('principal');
            $asi1 = Input::get('asistente1');
            $asi2 = Input::get('asistente2');
            $codpartido = Input::get('codpartido');
            $dniinsertado = ArbitroPorPartido::insertGetId(['principal'=>$prin,'asistente1'=>$asi1,'asistente2'=>$asi2]);

            Partido::where('codpartido','=',$codpartido)->update(['idarbitroporpartido'=>$dniinsertado]);

            $respuesta['mensaje'] = 'Arbitros de este partido ingresados correctamente';
            $respuesta['error'] = false;
        }
        return $respuesta;
    }
}