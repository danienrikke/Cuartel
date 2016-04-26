<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $primaryKey = 'codigo';

    protected $fillable = ['nombre'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['codigo'];
}
