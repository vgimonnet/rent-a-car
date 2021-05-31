<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonneMorale extends Model
{    
    use HasFactory;

    protected $table = 'personnes_morale';
    protected $primaryKey = 'id_personne_morale';

    public function coordonnee() {
        return $this->hasOne(Coordonnee::class, 'id_coordonnee');
    }

    public function conducteurs() {
        return $this->hasMany(Conducteur::class, 'id_personne');
    }

    public function delete() {
        // $this->conducteurs()->delete();
        $this->coordonnee()->delete();

        return parent::delete();
    }
}
