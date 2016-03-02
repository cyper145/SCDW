<?php

class Jugador extends Eloquent
{
    protected $table = 'tjugador';
    protected $primaryKey = 'dni';
	public $timestamps = false;
    //protected $fillable = ['dni','foto','estado','codEquipo','codDocente'];

    public function dataEquipo()
    {
        return $this->hasMany("Equipo", 'codEquipo', 'codEquipo');
    }

    public function dataDocente()
    {
        return $this->hasMany("Docente", 'codDocente', 'codDocente');
    }

}
