<?php
class Fixture extends Eloquent
{
    protected $table = 'tfixture';
    public $timestamps = false;
    protected $primaryKey = 'codFixture';

    //protected $fillable = ['idfixture','nropartido','hora','equipo1','equipo2','idfecha','idtorneo'];
/*

    public function dataEquipo1() {
        return $this->hasMany("Equipo", 'codequipo', 'equipo1');
    }

    public function dataEquipo2() {
        return $this->hasMany("Equipo", 'codequipo', 'equipo2');
    }
*/
}