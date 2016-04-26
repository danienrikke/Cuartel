<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $table = 'dependencias';

    protected $primaryKey = 'codigo';

    protected $fillable = ['nombre', 'actividad'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    protected $guarded = ['codigo'];
}