<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrativo extends Model
{
    use SoftDeletes;
	
    protected $table = 'administrativos';

    protected $primaryKey = 'cpersonal';
    
    protected $fillable = 
    	[
            'cedula',
			'profesion',
            'cargo',
            'dependencia'
        ];
                        
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'cpersonal', 'cedula');
    }
}