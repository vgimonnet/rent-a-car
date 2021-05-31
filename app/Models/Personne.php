<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Personne extends Model
{
    use HasFactory;

    private $table = 'personnes';
    private $primaryKey = 'id_personne';
    private $prenom;
    private $permis;

    public function coordonnee() {
        return $this->hasOne(Coordonnee::class);
    }

    public function setPermis(string $permis)
    {
        $this->permis = $permis;

        return $this;
    }

    public function getPermis()
    {
        return $this->permis;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
}
