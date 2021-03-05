<?php
namespace Modeles\Entites;

class Abonne extends Entite{
    private $pseudo;
    private $mdp;
    private $niveau;

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of mdp
     */ 
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @return  self
     */ 
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of niveau
     */ 
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set the value of niveau
     *
     * @return  self
     */ 
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }
}