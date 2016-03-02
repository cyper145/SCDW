<?php

class ArbitroPorPartido extends Eloquent
{
    protected $table = 'tarbitroxpartido';
    public $timestamps= false;
    protected $primaryKey = 'codArbxPart';
    //protected $fillable = ['idarbitroporpartido','rol','dni','codPartido'];





    public static function crear()
    {
        $nroP=DB::table('tpartido')->count();
        $nroAxP=DB::table('tarbitroxpartido')->count();
        return "AXP".($nroAxP+1).$nroP;
    }
    public static function isertar($input)
    {
        $respuesta = [];
        $reglas = [
            'arbitro'=>array('required'),
            'rol'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails())
        {
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else {
            $codpartido=Input::get('codpartido');
            $arbitro= Input::get('arbitro');
            $rol = Input::get('rol');

            $cod1 = self::crear();
            $AxP = new ArbitroPorPartido();
            $AxP->codArbxPart = $cod1;
            $AxP->rol = $rol;
            $AxP->dni = $arbitro;
            $AxP->codPartido = $codpartido;
            $AxP->save();
                $respuesta['mensaje'] = 'agregado correctamente ';
                $respuesta['error'] = false;
        }
        return $respuesta;
    }
}