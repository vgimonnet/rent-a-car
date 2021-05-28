<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    private $created_at;
    private $updated_at;
    private $vehicule_id;
    private $conducteur_id;
    private $employe_id;

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
