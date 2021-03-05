<?php

namespace Modeles\Entites;

class Association extends Entite
{
    private $id_association;
    private $id_vehicule;
    private $id_conducteur;

    /**
     * Get the value of id_association
     */
    public function getId_association()
    {
        return $this->id_association;
    }

    /**
     * Set the value of id_association
     *
     * @return  self
     */
    public function setId_association($id_association)
    {
        $this->id_association = $id_association;

        return $this;
    }

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
}
