<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use SoftDeletes;
	
    protected $table = 'medicos';

    protected $primaryKey = 'cpersonal';

    protected $fillable = 
    	[
            'cpersonal',
			'matricula',
			'especialidad',
            'consultorio'
        ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'cpersonal', 'cedula');
    }
}