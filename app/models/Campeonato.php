<?php

class Campeonato extends Eloquent
{
    protected $table = 'tcampeonato';
    public $timestamps= false;
    protected $primaryKey = 'codcampeonato';
    protected $fillable = ['codcampeonato','nombre','anioacademico','fechacreacion','reglamento','estado','idcom_orgdor'];

}