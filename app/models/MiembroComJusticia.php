<?php

class MiembroComJusticia extends Eloquent {
    protected $table = 'tmiembrocomjusticia';
    public $timestamps= false;
    protected $primaryKey = 'id';
    protected $fillable = ['id','rol','codcampeonato','coddocente'];

    public function dataDocente()
    {
        return $this -> hasMany("Docente",'coddocente','coddocente');
    }

    public function dataCampeonato()
    {
        return $this -> hasMany("Campeonato",'codcampeonato','codcampeonato');
    }
}