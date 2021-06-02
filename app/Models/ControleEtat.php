<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleEtat extends Model
{
    use HasFactory;

    protected $table = 'controles_etat';
    protected $primaryKey = 'id_controle_etat';

    public function employe()
    {
      return $this->hasOne(Employe::class);
    }

    public function contrat() {
        return $this->belongsTo(Contrat::class, 'id_contrat');
    }
    
    public function getInfo() {
        $contrat = $this->contrat;
        return $this->contrat->getInfo().' '.($this->type == 'entree'  ? ' (Contrôle d\'entrée)' : ' (Contrôle de sortie)');
    }
}
