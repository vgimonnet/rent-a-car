<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Personne
{
    use HasFactory;

    public function contrat()
    {
        return $this->belongsTo('Contrat');
    }
}
