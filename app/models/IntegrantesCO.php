<?php

class IntegrantesCO extends Eloquent{
    protected $table = 'tintegrantes_c_orgdor';
    public $timestamps = false;
    protected $fillable = ['id','rol','idcom_orgdor','coddocente'];

    public function DataDocente()
    {
        return $this -> hasMany("Docente",'coddocente','coddocente');
    }
}
