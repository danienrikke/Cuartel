<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    protected $table = 'consultorios';

    protected $primaryKey = 'codigo';

    protected $fillable = ['nombre'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    protected $guarded = ['codigo'];
}
