<?php

namespace Modeles\Entites;

class Vechicule extends Entite
{
    private $id_vehicule;
    private $modele;
    private $marque;
    private $couleur;
    private $immatriculation;

    /**
     * Get the value of id_vehicule
     */
    public function getId_vehicule()
    {
        return $this->id_vehicule;
    }

    /**
     * Set the value of id_vehicule
     *
     * @return  self
     */
    public function setId_vehicule($id_vehicule)
    {
        $this->id_vehicule = $id_vehicule;

        return $this;
    }

    /**
     * Get the value of modele
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }
    /**
     * Get the value of marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set the value of marque
     *
     * @return  self
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get the value of couleur
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set the value of couleur
     *
     * @return  self
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get the value of immatriculation
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set the value of immatriculation
     *
     * @return  self
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }
}
