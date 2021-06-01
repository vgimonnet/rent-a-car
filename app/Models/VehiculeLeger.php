<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeLeger extends Vehicule
{
    use HasFactory;

    protected $table = 'vehicules_leger';
    protected $primaryKey = 'id_vehicule';
}
