<?php

class JugadorEnJuego extends Eloquent
{
    protected $table = 'tjugadorenjuego';
    protected $primaryKey = 'idjugadorenjuego';
	public $timestamps = false;
	protected $fillable = ['nrocamiseta','condicionenpartido','escapitan','idjugador','codpartido'];
	
    public function dataEquipo()
    {
        return $this->hasMany("Equipo", 'codequipo', 'codequipo');
    }

    public static function isertar($input)
    {
        $respuesta = [];
        $reglas = [
            'codpartido'=>array('required'),
            'jugador'=>array('required'),
            'camiseta'=>array('required'),
            'escapitan'=>array('required'),
            'condicion'=>array('required')];
        $validador = Validator::make($input,$reglas);
        if($validador->fails())
        {
            $respuesta['mensaje'] = $validador;
            $respuesta['error'] = true;
        }
        else
        {
            $newjugadorenjuego = new JugadorEnJuego();
            $newjugadorenjuego ->nrocamiseta = Input::get('camiseta');
            $newjugadorenjuego ->condicionenpartido = Input::get('condicion');
            $newjugadorenjuego ->escapitan = Input::get('escapitan');
            $newjugadorenjuego ->idjugador = Input::get('jugador');
            $newjugadorenjuego ->codpartido = Input::get('codpartido');
            $newjugadorenjuego ->save();

            $respuesta['mensaje'] = 'Jugador agregado correctamente para este partido';
            $respuesta['error'] = false;
        }
        return $respuesta;
    }

}
