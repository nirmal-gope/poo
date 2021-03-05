<?php

namespace Modeles\Entites;

class Conducteur extends Entite
{
    private $id_conducteur;
    private $prenom;
    private $nom;

    /**
     * Get the value of id_conducteur
     */
    public function getId_conducteur()
    {
        return $this->id_conducteur;
    }

    /**
     * Set the value of id_conducteur
     *
     * @return  self
     */
    public function setId_conducteur($id_conducteur)
    {
        $this->id_conducteur = $id_conducteur;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
}
