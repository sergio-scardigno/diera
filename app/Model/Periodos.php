<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    protected $table = 'periodos';
    protected $primaryKey = 'id_periodo';
    protected $fillable = [ 'id_periodo', 'periodo', 'año', 'momento', 'en_carga', 'fecha_inicio', 'fecha_fin', 'fecha_cortedealtas' ];
}
