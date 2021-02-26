<?php
include "includes/functions.inc.php";
class MaClasse
{
}
class Voiture
{
    /*Les propriétes sont déclarés avec le mot-clé 'public' suivi d'un $puis le nom de la propriété*/
    public $marque;
    public $modele;
    public $couleur;
    /**Les méthodes sont déclarées aussi avecc le mot-clé 'public', puis comme la déclaration de n'importe quelle fonction */

    public function affecterMarque($marque)
    {
        $this->marque = $marque;  // it replace $voiture1->marque = "Ferrari";
    }

    public function carteGrise()
    {
        return "<ul>
                    <li>Marque : " . $this->marque . "</li>
                    <li>Modèle : " . $this->modele . "</li>
                    <li>Couleur : " . $this->couleur . "</li>
                </ul>";
    }

    /**Un CONSTRUCTEUR est une méthode liée à une classe qui se déclenche à chaque fois qu'un object est instancié 
     * En PHP , le constructeur s'appelle __construct() ( il y a deux_) */

    public function __construct($marque, $modele, $couleur = null)
    {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->couleur = $couleur;
    }
}
/**On peut déclarer des variables object à partir d'une classe : il faut utiliser le mot-clé 'new' suivi de la classe */
// $voiture1 = new voiture;
// dump($voiture1);
// $voiture1->marque = "Ferrari";
// $voiture1->modele = "Testarossa";
// $voiture1->couleur = "rouge";
// dump($voiture1);
// 
?>
// <p>Quelle est la couleur de la Ferrari ?</p>
// <?php
    // echo $voiture1->couleur;
    // dump($voiture1->couleur);

    // /**Instranciez (=déclarez) un object voiture et affectez les valeur Porche 911 noire aux propriétés puis affichez les propriétés de l'objet dans une balise <ul> */
    // $voiture2 = new voiture;
    // $voiture2->marque = "Porche";
    // $voiture2->modele = "911 GT";
    // $voiture2->couleur = "noire";
    // echo "<ul>";
    // echo "<li> Marque : " . $voiture2->marque . "</li>";
    // echo "<li> Modele : " . $voiture2->modele . "</li>";
    // echo "<li> Couleur : " . $voiture2->couleur . "</li>";
    // echo "</ul>";

    // $voiture1->affecterMarque("Renault");  // it replace $voiture1->marque = "Ferrari"; 
    // echo "<ul>";
    // echo "<li> Marque : " . $voiture1->marque . "</li>";
    // echo "<li> Modele : " . $voiture1->modele . "</li>";
    // echo "<li> Couleur : " . $voiture1->couleur . "</li>";
    // echo "</ul>";

    // /**EXO: écrire une méthode carteGrise() qui retourne un string qui contient les propriétés d'un objet voiture dans une balise ul */

    // $voiture3 = new voiture;
    // $voiture3->marque = "BMW";
    // $voiture3->modele = "GTN";
    // $voiture3->couleur = "blue";
    // echo $voiture3->carteGrise();
    // echo $voiture2->carteGrise();


    $voitureProche = new voiture("Proche", "911 GT", "noire");
    echo $voitureProche->carteGrise();

    $nouvelleVoiture = new voiture("Audi", "A4",);
    echo $nouvelleVoiture->carteGrise();
