<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Personne
{
    use HasFactory;

    protected $table = 'conducteurs';
    protected $primaryKey = 'id_personne';

    public function personneMorale() {
        return $this->belongsTo(PersonneMorale::class, 'id_personne_morale');
    }
}
