<?php

class Docente extends Eloquent{
    protected $table = 'tdocente';
    public $timestamps= false;
    protected $primaryKey = 'codDocente';
    protected $fillable = ['codDocente','nombre','apellidoP','apellidoM','email','categoria','codDptoAcademico'];

    public function dataDptoAcademico()
    {
       return $this -> hasMany("DptoAcademico",'codDptoAcademico','codDptoAcademico');
    }
}