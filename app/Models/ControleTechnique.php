<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleTechnique extends Model
{
    use HasFactory;

    private $table = 'controles_technique';
    private $conforme;
    private $dateControle;
    private $contreVisite;
    private $dateContreVisite;
    private $commentaire;

    public function getConforme(string $conforme)
    {
        return $this->conforme;
    }
    
    public function setConforme(string $conforme)
    {
        $this->conforme = $conforme;
        return $this;
    }

    public function getDateControle(string $dateControle)
    {
        return $this->dateControle;
    }
    
    public function setDateControle(string $dateControle)
    {
        $this->dateControle = $dateControle;
        return $this;
    }

    public function getContreVisite(string $contreVisite)
    {
        return $this->contreVisite;
    }
    
    public function setContreVisite(string $contreVisite)
    {
        $this->contreVisite = $contreVisite;
        return $this;
    }

    public function getDateContreVisite(string $dateContreVisite)
    {
        return $this->dateContreVisite;
    }
    
    public function setDateContreVisite(string $dateContreVisite)
    {
        $this->dateContreVisite = $dateContreVisite;
        return $this;
    }

    public function getCommentaire(string $commentaire)
    {
        return $this->commentaire;
    }
    
    public function setCommentaire(string $commentaire)
    {
        $this->commentaire = $commentaire;
        return $this;
    }
}
