<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class regiones extends Model
{
    protected $table = 'regiones';
    protected $primaryKey = 'id_region_educativa';
    protected $fillable = [ 'id_region_educativa', 'nombre'];
}
