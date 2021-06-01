<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeUtilitaire extends Vehicule
{
    use HasFactory;

    protected $table = 'vehicules_utilitaire';
    protected $primaryKey = 'id_vehicule';
}
