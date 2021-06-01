<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Vehicule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vehicule';

    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'id_contrat');
    }

    public function controles_technique()
    {
        return $this->hasMany(ControleTechnique::class, 'id_controle_technique');
    }

    public function controles_etat() {
        return $this->hasMany(ControleEtat::class, 'id_controle_etat');
    }

    public function getInfoVehicule() {
        return $this->marque.' - '.$this->modele.' ('.$this->immatriculation.')';
    }

}
