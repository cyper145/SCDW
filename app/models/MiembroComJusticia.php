<?php

class MiembroComJusticia extends Eloquent {
    protected $table = 'tmiembrojusticia';
    public $timestamps= false;
    protected $primaryKey = 'dni';
    protected $fillable = ['dni','rol','nombre','apellidoP','apellidoM','codCampeonato'];

    public function dataCampeonato()
    {
        return $this -> hasMany("Campeonato",'codCampeonato','codCampeonato');
    }
}