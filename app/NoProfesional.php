<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoProfesional extends Model
{
    use SoftDeletes;
	
    protected $table = 'noprofesionales';

    protected $primaryKey = 'cpersonal';
    
    protected $fillable = 
        [
    		'cpersonal',
    		'tmilitar',
    		'jerarquia',
    		'ncuenta',
    		'contingente',
    		'situacion',
    		'dtallas',
    		'nasignado'
        ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'cpersonal', 'cedula');
    }
}
