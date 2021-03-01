<?php

$objet1 = new stdClass;
$objet1->pseudo = "luke";
$objet1->mdp = "sky";

$array1 = [ "pseudo" => "luke", "mdp" => "sky" ];
echo "<pre>"; var_dump($objet1, $array1); echo "</pre>";

echo "La propriété pseudo de \$objet1 est " . $objet1->pseudo . "<br>";

/* Pour créer une classe, on utilise le mot-clé 'class' suivi du nom que l'on veut donner à la classe
        Convention de nommage : les noms de classe commencent par UNE MAJUSCULE et utilisent la casse CamelCase
*/
class Voiture{
    /* Pour ajouter des propriétés à une classe, on utilise le mot-clé public suivi de $ et du nom de la propriété
        NB : dans la Programmation Orienté Objet, on peut dire que les variables s'appellent propriétés
    */
    public $marque;
    public $modele;
    public $couleur;

    /* On peut aussi ajouter des méthodes à cette classe en utilisant les mots-clés 'public function'
        NB : dans la Programmation Orienté Objet, on peut dire que les fonctions s'appellent méthodes 
    
        Dans le code de la classe, dans une méthode, si je veux utiliser l'objet en cours, j'utilise
        $this. Donc $this est un objet de la classe Voiture.
    */
    public function demarrer(){
        echo "Je suis une voiture de la marque " . $this->marque .  ", je démarre...<br>";
    }

    public function changeCouleur($nouvelleCouleur){
        $this->couleur = $nouvelleCouleur;
    }

    /* EXO : créer une méthode carteGrise() qui retourne les informations de la voiture en string (liste ul )
        Marque : ....
        Modèle : ...
        Couleur : ...

        2. Afficher les informations de voiture1 et voiture2 en utilise la méthode carteGrise
    */
    public function carteGrise(){
        return "<ul>
                    <li>Marque : " . $this->marque . "</li>
                    <li>Modèle : " . $this->modele . "</li>
                    <li>Couleur : " . $this->couleur . "</li>
                </ul>";
    }

}

/* Pour déclarer un objet d'une classe, il faut utiliser le mot-clé 'new'. Cela s'appelle INSTANCIER un objet */
$voiture1 = new Voiture;
$voiture1->marque = "Renault";
$voiture1->modele = "Megane";
$voiture1->couleur = "orange";
// EXO : Ma voiture de marque ..., modèle ... est de couleur ... <br>
//       Instancier un nouvel objet Voiture avec les valeurs de propriétés que vous voulez
//       Faites "démarrer" la voiture 
echo "Ma voiture " . $voiture1->marque . ", " . $voiture1->modele . " est de couleur " . $voiture1->couleur . "<br>";
$voiture1->demarrer();
$voiture2 = new Voiture;
$voiture2->marque = "Audi";
echo "<h2>";
$voiture2->demarrer();
echo "</h2>";
$voiture1->changeCouleur("vert caca d'oie");
echo "<pre>"; var_dump($voiture1); echo "</pre>";

$voiture1->moteur = "V12";
echo "<pre>"; var_dump($voiture1, $voiture2); echo "</pre>";

echo $voiture1->carteGrise();
echo $voiture2->carteGrise();