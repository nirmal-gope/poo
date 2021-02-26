<?php
class Personne
{
    /**une CONSTANTE DE CLASSE est une constante liée à une classe
     * ex:
     *  echo Personne::AGE_MAJORITE;
     * PDO::FETCH_ASSOC
     */
    public const AGE_MAJORITE = 18;

    /**une PROPRIETE STATIQUE est une propriété qui liée à une classe
     * Pour utiliser une propriété statique, il faut utiliser le nom de la classe suivi de :: suivi de $ et du nom de la propriéte
     * par exemple ,
     *  echo Personne:: $compteur;
     */
    public static $compteur = 0;

    private $nom;
    protected $prenom;
    protected $anneeNaissance;

    public function __construct()
    {
        self::$compteur++;
    }

    /**Les méthodes de classe (ou méthodes statiques) sont des méthodes liées à une classe et pas à un objet. C'est-à-dire que pour l'utiliser on n'a pas besoin de déclarer un objet. On va l'utiliser en nommant la classe suivi de l'opérateur :: suivi du nom de la méthode
     *  ex: Personne::calculAge(1999) 
     * Pour déclarer une méthode statique, on utilise le mot-clé static avant (ou aprés) public (ou protected, ou private)
     * On ne peut pas utiliser $this dans une méthode statique
     * */
    static public function calculAge($annee)
    {
        /**La fonction date($format) renvoie la date du jour selon le format passé en paramètre 
         * Le format peut être égal à "d/m/y" pour avoir la date au format français "y" permet de récupérer uniquement l'année sur 4 chiffres
         */
        $anneeActuelle = date("Y");
        return $anneeActuelle - $annee;
    }
    /**Le mot-clé 'self' est utilisé pour faire référence à la classe dans laquelle on se trouve pour pouvoir appeler une méthode statique déclarré dans la classe actuelle , il faut utiliser le mot-clé "self"
     * par exemple: 
     * self::calculeAge(1960)
     */
    static public function majorite($annee)
    {
        if (self::calculAge($annee) >= self::AGE_MAJORITE) {
            return "majeur";
        } else {
            return "mineur";
        }
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
     * Get the value of anneeNaissance
     */
    public function getAnneeNaissance()
    {
        return $this->anneeNaissance;
    }

    /**
     * Set the value of anneeNaissance
     *
     * @return  self
     */
    public function setAnneeNaissance($anneeNaissance)
    {
        $this->anneeNaissance = $anneeNaissance;

        return $this;
    }
}
