<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'contrats';
    protected $primaryKey = 'id_contrat';
    private $created_at;
    private $updated_at;

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

    public function getVehiculeId(string $vehicule_id)
    {
        return $this->vehicule_id;
    }
    
    public function setVehiculeId(string $vehicule_id)
    {
        $this->vehicule_id = $vehicule_id;
        return $this;
    }

    public function getConducteurId(string $conducteur_id)
    {
        return $this->conducteur_id;
    }
    
    public function setConducteurId(string $conducteur_id)
    {
        $this->conducteur_id = $conducteur_id;
        return $this;
    }

    public function getEmployeId(string $employe_id)
    {
        return $this->employe_id;
    }
    
    public function setEmployeId(string $employe_id)
    {
        $this->employe_id = $employe_id;
        return $this;
    }
}
