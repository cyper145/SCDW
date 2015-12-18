<?php

class Jugador extends Eloquent
{
    protected $table = 'tjugador';
    protected $primaryKey = 'idjugador';
	public $timestamps = false;
    protected $fillable = ['idjugador','foto','estado','codequipo','coddocente'];

    public function dataEquipo()
    {
        return $this->hasMany("Equipo", 'codequipo', 'codequipo');
    }

    public function dataDocente()
    {
        return $this->hasMany("Docente", 'coddocente', 'coddocente');
    }

}
