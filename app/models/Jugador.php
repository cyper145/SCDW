<?php

class Jugador extends Eloquent
{
    protected $table = 'tjugador';
    protected $primaryKey = 'dni';
	public $timestamps = false;

	protected $fillable = ['dni','foto','estado','codequipo','coddocente'];


    public function dataEquipo() {
        return $this->hasMany("Equipo", 'codequipo', 'codequipo');
    }

    public function dataDocente() {
        return $this->hasMany("Docente", 'coddocente', 'coddocente');
    }

}
