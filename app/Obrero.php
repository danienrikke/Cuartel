<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obrero extends Model
{
    use SoftDeletes;
	
    protected $table = 'obreros';

    protected $primaryKey = 'cpersonal';

    protected $fillable = 
        [
            'cpersonal', 
            'ginstruccion',
            'tobrero',
            'area'
        ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'cpersonal', 'cedula');
    }
}
