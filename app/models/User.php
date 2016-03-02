<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var stringF
	 */
	protected $table = 'tusuarios';
    public $timestamps=false;
    protected $primaryKey = 'idUsuario';
    protected $fillable = ['idUsuario','username','password','tipo','estado'];

    public function DataComision()
    {
        return $this->hasMany('Comision', 'idUsuario', 'idUsuario');
    }

    public function DataEquipo()
    {
        return $this->hasMany('Equipo', 'idUsuario', 'idUsuario');
    }
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
        
        
        //funciones de manejo de sesion
        public static function isLogged()
	{
            if(Session::has('user_id'))
                return true;
            else
                return false;
	}
        public static function isAdministrator()
	{
            if(Session::get('user_type') == 'administrador')
                return true;
            else
                return false;
        }
        public static function isOrganizingCommittee()
	{
            if(Session::get('user_type') == 'comision organizadora')
                return true;
            else
                return false;
        }
        public static function isEquipo()
	{
            if(Session::get('user_type') == 'equipo')
                return true;
            else
                return false;
        }
}
