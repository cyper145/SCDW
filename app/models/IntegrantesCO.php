<?php

class IntegrantesCO extends Eloquent{
    protected $table = 'tint_com_org';
    public $timestamps = false;
    protected $primaryKey = 'dni';
    protected $fillable = ['dni','rol','codCom_Org','codDocente'];

    public function DataDocente()
    {
        return $this -> hasMany("Docente",'codDocente','codDocente');
    }
}
