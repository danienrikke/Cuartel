<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesional extends Model
{
    use SoftDeletes;
	
    protected $table = 'profesionales';

    protected $primaryKey = 'cpersonal';
    
    protected $fillable = 
        [
    		'cpersonal',
    		'tmilitar',
    		'jerarquia',
    		'matricula',
    		'especialidad',
    		'dtallas',
    		'iproveniente',
    		'fuascenso',
            'cargo',
            'dependencia'
        ];
                         
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'cpersonal', 'cedula');
    }
}
