<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleEtat extends Model
{
    use HasFactory;

    protected $table = 'controles_etat';
    protected $primaryKey = 'id_controle_etat';
    private $date;
    private $kilometrage;
    private $etatExterieur;
    private $etatInterieur;
    private $fraisAPrevoir;

    public function getDate(string $date)
    {
        return $this->date;
    }
    
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }

    public function getKilometrage(string $kilometrage)
    {
        return $this->kilometrage;
    }
    
    public function setKilometrage(string $kilometrage)
    {
        $this->kilometrage = $kilometrage;
        return $this;
    }

    public function getEtatExterieur(string $etatExterieur)
    {
        return $this->etatExterieur;
    }
    
    public function setEtatExterieur(string $etatExterieur)
    {
        $this->etatExterieur = $etatExterieur;
        return $this;
    }

    public function getEtatInterieur(string $etatInterieur)
    {
        return $this->etatInterieur;
    }
    
    public function setEtatInterieur(string $etatInterieur)
    {
        $this->etatInterieur = $etatInterieur;
        return $this;
    }

    public function getFraisAPrevoir(string $fraisAPrevoir)
    {
        return $this->fraisAPrevoir;
    }
    
    public function setFraisAPrevoir(string $fraisAPrevoir)
    {
        $this->fraisAPrevoir = $fraisAPrevoir;
        return $this;
    }
}
