<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Personne
{
    use HasFactory;

    protected $table = 'employes';
    protected $primaryKey = 'id_employe';
    
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'id_contrat');
    }

    public function coordonnee() {
        return $this->hasOne(Coordonnee::class, 'id_coordonnee');
    }

    public function controles_etat()
    {
        return $this->hasMany(ControleEtat::class, 'id_controle_etat');
    }
}
