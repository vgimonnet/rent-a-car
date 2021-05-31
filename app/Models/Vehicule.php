<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $table = 'vehicules';
    protected $primaryKey = 'immatriculation';
    private $disponible;
    private $poids;
    private $marque;
    private $modele;
    private $coutParJour;
    private $dateAnciennete;
    private $couleur;
    private $places;
    private $contenanceCoffre;
    private $hauteur;

    public function contrat()
    {
        return $this->belongsTo('Contrat');
    }

    public function controle_technique()
    {
        return $this->belongsTo(ControleTechnique::class);
    }

    public function getDisponible(string $disponible)
    {
        return $this->disponible;
    }
    
    public function setDisponible(string $disponible)
    {
        $this->disponible = $disponible;
        return $this;
    }

    public function getPoids(string $poids)
    {
        return $this->poids;
    }
    
    public function setPoids(string $poids)
    {
        $this->poids = $poids;
        return $this;
    }

    public function getMarque(string $marque)
    {
        return $this->marque;
    }
    
    public function setMarque(string $marque)
    {
        $this->marque = $marque;
        return $this;
    }

    public function getModele(string $modele)
    {
        return $this->modele;
    }
    
    public function setModele(string $modele)
    {
        $this->modele = $modele;
        return $this;
    }

    public function getCoutParJour(string $coutParJour)
    {
        return $this->coutParJour;
    }
    
    public function setCoutParJour(string $coutParJour)
    {
        $this->coutParJour = $coutParJour;
        return $this;
    }

    public function getDateAnciennete(string $dateAnciennete)
    {
        return $this->dateAnciennete;
    }
    
    public function setDateAnciennete(string $dateAnciennete)
    {
        $this->dateAnciennete = $dateAnciennete;
        return $this;
    }

    public function getCouleur(string $couleur)
    {
        return $this->couleur;
    }
    
    public function setCouleur(string $couleur)
    {
        $this->couleur = $couleur;
        return $this;
    }

    public function getPlaces(string $places)
    {
        return $this->places;
    }
    
    public function setPlaces(string $places)
    {
        $this->places = $places;
        return $this;
    }

    public function getContenance(string $contenance)
    {
        return $this->contenance;
    }
    
    public function setContenance(string $contenance)
    {
        $this->contenance = $contenance;
        return $this;
    }

    public function getHauteur(string $hauteur)
    {
        return $this->hauteur;
    }
    
    public function setHauteur(string $hauteur)
    {
        $this->hauteur = $hauteur;
        return $this;
    }
}
