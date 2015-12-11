<?php

class JugadorEnJuego extends Eloquent
{
    protected $table = 'tjugadorenjuego';
    protected $primaryKey = 'idjugadorenjuego';
	public $timestamps = false;

	protected $fillable = ['nrocamiseta','condicionenpartido','escapitan','dni','codpartido'];

	
    public function dataEquipo() {
        return $this->hasMany("Equipo", 'codequipo', 'codequipo');
    }

    public function dataJugador()
    {
        return $this -> hasMany('');
    }
	
	/*
    public function dataPlanilla() {
        return $this->hasMany("Planilla", 'nroplanilla', 'nroplanilla');
    }

    */
}
