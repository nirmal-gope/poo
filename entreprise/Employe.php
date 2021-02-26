<?php

/**En Programation Orienté Objet, une classe = un fichier
 * Dans le fichier contenant la déclaration de la classe, il n'y aura QUE la définition da la classe 
 * Le nom du fichier DOIT être identique au nom de la classe (majuscule au début du nom) 
 */
class Employe extends Personne
{
    private $service;
    private $salaire;

    /**
     * Get the value of service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @return  self
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of salaire
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set the value of salaire
     *
     * @return  self
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }
}
