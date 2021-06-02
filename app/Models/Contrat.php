<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'contrats';
    protected $primaryKey = 'id_contrat';

    public function vehicule_leger()
    {
      return $this->belongsTo(VehiculeLeger::class, 'id_vehicule');
    }

    public function vehicule_utilitaire()
    {
      return $this->belongsTo(VehiculeUtilitaire::class, 'id_vehicule');
    }

    public function conducteur()
    {
      return $this->belongsTo(Conducteur::class, 'id_conducteur');
    }

    public function employe()
    {
      return $this->belongsTo(Employe::class, 'id_employe');
    }

    public function controle_etat_sortie() {
        return $this->hasOne(ControleEtat::class, 'id_controle_etat');
    }

    public function controle_etat_entree() {
        return $this->hasOne(ControleEtat::class, 'id_controle_etat');
    }

    public function getVehicule() {
        if ($this->type_vehicule == 'vehicule_leger') {
            return VehiculeLeger::find($this->id_vehicule);
        } else if ($this->type_vehicule == 'vehicule_utilitaire') {
            return VehiculeUtilitaire::find($this->id_vehicule);
        } else {
            return null;
        }
    }

    public function getInfo() {
        $info = '';
        if ($this->conducteur) {
            $info .= $this->conducteur->nom.' '.$this->conducteur->prenom.($this->conducteur->est_particulier ?: ' ('.$this->conducteur->personneMorale->societe.') ');
        }
        if ($this->getVehicule()) {
            $info .= $this->getVehicule()->getInfoVehicule();
        }

        return $info;
    }
}
