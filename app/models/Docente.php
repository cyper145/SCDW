<?php

class Docente extends Eloquent{
    protected $table = 'tdocente';
    public $timestamps= false;
    protected $primaryKey = 'coddocente';
    protected $fillable = ['coddocente','nombre','apellidopaterno','apellidomaterno','categoria','dni','direccion','email','edad','telefono','coddptoacademico'];

    public function dataDptoAcademico()
    {
       return $this -> hasMany("DptoAcademico",'coddptoacademico','coddptoacademico');
    }
}