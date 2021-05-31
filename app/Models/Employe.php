<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Personne
{
    use HasFactory;

    protected $table = 'employes';
    protected $primaryKey = 'id_employe';
    
    public function contrat()
    {
        return $this->belongsTo('Contrat');
    }

    public function controle_etat()
    {
        return $this->belongsTo(ControleEtat::class);
    }
}
