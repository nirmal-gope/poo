<?php
include "includes/functions.inc.php";
class A
{
    public $nom;
    public $prenom;

    public function presentation()
    {
        return "Bonjour, je m'appelle " . $this->prenom . " " . $this->nom;
    }
    public function identite()
    {
        return $this->nom . ", " . $this->prenom;
    }
}
/**Le mot 'extends' permet de définir l'héritage d'une classe vers une autre
 * Une classe qui hérite d'une autre classe, possède toutes les propriétés de la classe dont elle hérite
 */
class B extends A
{
    public $age;
    /**SURCHARGER UNE METHODE : se je définis dans ma classe une méthode qui existe dans la classe parent on appelle cella une surcharge. Elle "écrase" la définition de la méthode de la classe parent 
     * 
     * PARENT: pour utiliser la méthode de la classe parent, il faut utiliser le mot-clé "parent" suivi par :: et le nom de la méthode  
     */

    public function presentation()
    {
        $texte = parent::presentation();
        return $texte . " et j'ai " . $this->age . " ans";
    }
}
class C extends B
{
    public $profession;
    return "Je suis ". $this->prenom . " et ma profession est " . $this->profession;
}
$objA = new A;
$objB = new B;
$objC = new C;


dump($objA);
dump($objB);
dump($objC);

$objA->nom = "Cérien";
$objA->prenom = "Jean";

$objB->age = 30;
$objB->prenom = "Gérard";
$objB->nom = "Mentor";

$objA->anneeNaissance = 24;

echo "<hr>";
dump($objA);
dump($objB);

echo "<h1>Présentation</h1>";

// $objA->presentation();
echo $objB->presentation();
echo "<br>";

$objC->nom = "Neymar";
$objC->prenom = "Jean";
$objC->age = 54;
$objC->profession = "Informaticien";
echo $objC->presentation();
echo "<br>";
echo $objC->identite();
