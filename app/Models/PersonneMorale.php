<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonneMorale extends Model
{    
    use HasFactory;

    protected $primaryKey = 'id_personne_morale';

    public function coordonnee() {
        return $this->hasOne(Coordonnee::class);
    }
}
