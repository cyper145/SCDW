<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/02/2016
 * Time: 18:56
 */
class Delegado extends Eloquent {

    protected $table = 'tdelegando';
    public $timestamps= false;
    protected $primaryKey='dni';
    public function dataEquipo()
    {
        return $this->hasMany("Equipo", 'codEquipo', 'codEquipo');
    }

    public function dataDocente()
    {
        return $this->hasMany("Docente", 'codDocente', 'codDocente');
    }
}