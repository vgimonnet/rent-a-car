<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_coordonnee';

    public function personneMorale()
    {
        return $this->belongsTo(PersonneMorale::class, 'id_personne_morale');
    }

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }
}