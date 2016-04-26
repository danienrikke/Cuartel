<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
	protected $table = 'asistencias';

    protected $primaryKey = 'codigo';

    protected $fillable = ['cpersonal', 'turno', 'hora_salida', 'hora_entrada', 'fecha'];

    public $timestamps = false;
    
    protected $guarded = ['codigo'];
}
