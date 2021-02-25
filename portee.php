<?php
class A
{
    /**Les propriétés publiques sont visibles (accesibles) partout */
    public $nom;
    /**Les propriétés privées ne sont visibles (accesibles) que dans la définition de la classe */
    private $prenom;

    public function __construct($nom, $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /**GETTER : méthode pour récupérer la valeur d'une propriété privée */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**SETTER : méthode pour définir la valeur d'une propriété privée */

    public function setPrenom($nouveauPrenom)
    {
        $this->prenom = $nouveauPrenom;
    }
}

class B extends A
{
    public $age;
    public function __construct($nouveauPrenom, $nouveauNom, $nouvelAge)
    {
        /**Je ne peux pas écrire $this->prenom ici parce que la propriété est privée dans la classe A */
        $this->setPrenom($nouveauPrenom);
        $this->nom = $nouveauNom;
        $this->age = $nouvelAge;
    }
}
class C extends B
{
    public $profession;
}


$objA = new A("Parker", "Peter");
$objA->setPrenom("Lewis");


echo "<ul>";
echo "<li>Nom : " . $objA->nom . "</li>";
echo "<li>Prénom : " . $objA->getPrenom() . "</li>";
echo "</ul>";


/**l'objet $objA n'a pas accès à la propriété privée "prenom", donc on ne peut ni lui donner uner valeur ni l'afficher */

echo "<pre>";
var_dump($objA);
echo "</pre>";

$objB = new B("Mona", "Staire", 42);
echo "<ul>";
echo "<li>Nom : " . $objB->nom . "</li>";
echo "<li>Prénom : " . $objB->getPrenom() . "</li>";
echo "<li>Age: " . $objB->age . "</li>";
echo "</ul>";
