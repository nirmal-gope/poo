<?php
class Client extends Personne
{
    public static $cpt = 0;


    private $nb_commandes;
    private $adresse_livraison;

    public function getNom()
    {
        self::$cpt++;
        return parent::getNom();
    }




    /**
     * Get the value of nb_commandes
     */
    public function getNb_commandes()
    {
        return $this->nb_commandes;
    }

    /**
     * Set the value of nb_commandes
     *
     * @return  self
     */
    public function setNb_commandes($nb_commandes)
    {
        $this->nb_commandes = $nb_commandes;

        return $this;
    }

    /**
     * Get the value of adresse_livraison
     */
    public function getAdresse_livraison()
    {
        return $this->adresse_livraison;
    }

    /**
     * Set the value of adresse_livraison
     *
     * @return  self
     */
    public function setAdresse_livraison($adresse_livraison)
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }
}
