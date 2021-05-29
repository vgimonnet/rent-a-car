<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Personne
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'employes';
    protected $primaryKey = 'id_personne';
=======
    public function contrat()
    {
        return $this->belongsTo('Contrat');
    }
>>>>>>> origin/main
}
