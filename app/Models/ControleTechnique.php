<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleTechnique extends Model
{
    use HasFactory;

    protected $table = 'controles_technique';
    protected $primaryKey = 'id_controle_technique';

    public function vehicule()
    {
      return $this->belongsTo(Vehicule::class, 'id_vehicule');
    }

    public function getVehicule() {
        $vehicule = VehiculeLeger::where('immatriculation', '=', $this->id_vehicule)->get();
        if (empty($vehicule)) {
          $vehicule = VehiculeUtilitaire::where('immatriculation', '=', $this->id_vehicule)->get();
        }
        if(!empty($vehicule) && sizeof($vehicule) > 0) {
            return $vehicule[0];
        }

        return null;
    }
}
