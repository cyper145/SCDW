<?php
class Equipoxtorneo extends Eloquent
{
    protected $table = 'tequipoxtorneo';
    public $timestamps = false;
    protected $primaryKey = 'idequipoxtorneo';

    protected $fillable = ['idequipoxtorneo','codequipo','idtorneo'];


    public function DataEquipo() {
        return $this->hasMany("Equipo", 'codequipo', 'codequipo');
    }
}