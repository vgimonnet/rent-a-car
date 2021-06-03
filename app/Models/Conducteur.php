<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Personne
{
    use HasFactory;

    protected $table = 'conducteurs';
    protected $primaryKey = 'id_conducteur';

    public function personneMorale() {
        return $this->belongsTo(PersonneMorale::class, 'id_personne_morale');
    }

    public function coordonnee() {
        return $this->hasOne(Coordonnee::class, 'id_coordonnee');
    }
    
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'id_contrat');
    }

    public function getInfo() {
        return strtoupper($this->nom).' '.$this->prenom.( $this->personneMorale ? ' (Société : '.$this->personneMorale->societe.')' : '');
    }
}
