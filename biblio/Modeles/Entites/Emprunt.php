<?php
namespace Modeles\Entites;

class Emprunt extends Entite{
    private $date_emprunt;
    private $date_retour;
    private $abonne_id;
    private $livre_id;


    /**
     * Get the value of date_emprunt
     */ 
    public function getDate_emprunt()
    {
        return $this->date_emprunt;
    }

    /**
     * Set the value of date_emprunt
     *
     * @return  self
     */ 
    public function setDate_emprunt($date_emprunt)
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    /**
     * Get the value of date_retour
     */ 
    public function getDate_retour()
    {
        return $this->date_retour;
    }

    /**
     * Set the value of date_retour
     *
     * @return  self
     */ 
    public function setDate_retour($date_retour)
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    /**
     * Get the value of abonne_id
     */ 
    public function getAbonne_id()
    {
        return $this->abonne_id;
    }

    /**
     * Set the value of abonne_id
     *
     * @return  self
     */ 
    public function setAbonne_id($abonne_id)
    {
        $this->abonne_id = $abonne_id;

        return $this;
    }

    /**
     * Get the value of livre_id
     */ 
    public function getLivre_id()
    {
        return $this->livre_id;
    }

    /**
     * Set the value of livre_id
     *
     * @return  self
     */ 
    public function setLivre_id($livre_id)
    {
        $this->livre_id = $livre_id;

        return $this;
    }
}