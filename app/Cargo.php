<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
	protected $table = 'cargos';

    protected $primaryKey = 'codigo';

    protected $fillable = ['tipo', 'descripcion'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    protected $guarded = ['codigo'];
}
