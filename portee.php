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
    /**Accessibilité PROTECTED: La protected ou la méthode ptotégée ast accessible dans la classe et dans les classes qui héritent. Comme pour PRIVATE, l'objet n'a pas accès à cette propriété ou méthode  */
    protected $age;
    public function __construct($nouveauPrenom, $nouveauNom, $nouvelAge)
    {
        /**Je ne peux pas écrire $this->prenom ici parce que la propriété est privée dans la classe A */
        // $this->setPrenom($nouveauPrenom);
        // $this->nom = $nouveauNom;
        parent::__construct($nouveauNom, $nouveauPrenom);
        $this->age = $nouvelAge;
    }
    /**Lorsqu'on a des propriétés privées, on doit définir des méthodes GETTER est SETTER pour ces propriétés. 
     * Convention de nomage: 
     * les méthodes GETTER commencent par 'get' 
     * les méthodes SETTER commencent par 'set' 
     * suivi du nom de la propriété (en utilisant le camelCase)
     * 
     */
    public function getAge()
    {
        return $this->age;
    }
}
class C extends B
{
    public $profession;
    /**Ecrire une méthode qui retourne un string contenant toutes les informations de l'objet (nom, prenom, age, profession) */

    public function identite()
    {
        $html = "<ul>";
        $html .= "<li>Nom : " . $this->nom . "</li>";
        $html .= "<li>Prénom : " . $this->getPrenom() . "</li>";
        $html .= "<li>Age : " . $this->age . "</li>";
        $html .= "<li>Profession : " . $this->profession . "</li>";
        $html .= "</ul>";
        return $html;
    }
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
echo "<li>Age: " . $objB->getAge() . "</li>";
echo "</ul>";

$personne = new C("Bruce", "Banner", 50);
$personne->profession = "Professeur";
$personne->getAge();
/**La méthode identite() retourne un string, donc je peux  (je doit) l'utiliser comme un string */
echo "<div>" . $personne->identite() . "</div>";
