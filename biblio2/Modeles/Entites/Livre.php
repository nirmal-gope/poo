<?php
namespace Modeles\Entites;

class Livre extends Entite{
    private $titre;
    private $auteur;
    private $couverture;

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of auteur
     */ 
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */ 
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get the value of couverture
     */ 
    public function getCouverture()
    {
        return $this->couverture;
    }

    /**
     * Set the value of couverture
     *
     * @return  self
     */ 
    public function setCouverture($couverture)
    {
        $this->couverture = $couverture;

        return $this;
    }
}