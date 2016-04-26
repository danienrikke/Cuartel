<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use SoftDeletes;

	protected $table = 'personal';

    protected $primaryKey = 'cedula';
    
    protected $fillable = 
    	[
    		'cedula',
    		'nombre',
    		'apellido',
    		'fnacimiento',
    		'sexo',
    		'direccion',
    		'telefono',
    		'fingreso',
    		'ecivil',
    		'nhijos',
    		'tpersonal'
    	];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function obreros()
    {
        return $this->hasOne('App\Obrero', 'cpersonal', 'cedula');
    }

    public function medicos()
    {
        return $this->hasOne('App\Medico', 'cpersonal', 'cedula');
    }

    public function administrativos()
    {
        return $this->hasOne('App\Administrativo', 'cpersonal', 'cedula');
    }

    public function profesionales()
    {
        return $this->hasOne('App\Profesional', 'cpersonal', 'cedula');
    }

    public function noprofesionales()
    {
        return $this->hasOne('App\NoProfesional', 'cpersonal', 'cedula');
    }
}
