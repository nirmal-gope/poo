<?php
include "Personne.php";
include "Employe.php";
include "Client.php";


$e1 = new Employe;
$e1->setNom("Stark");
$e1->setPrenom("Tony");
$e1->setAnneeNaissance(1964);


echo "Employé : " . $e1->getPrenom() . " " . $e1->getNom() . "<br>";
echo "Quel est l'âge d'une personne née en 1975 ? " . Personne::calculAge(1975) . "<br>";
echo "Quel est l'âge de " . $e1->getPrenom() . " " . $e1->getNom() . " ? " . $e1->calculAge($e1->getAnneeNaissance()) . "<br>";


$p = new Personne;
$p1 = new Personne;


echo "Il y a " . Personne::$compteur . " objets de la classe Personne qui ont été instanciés <br>";
echo "Il y a " . Employe::$compteur . " objets de la classe Employe qui ont été instanciés  <br>";

/*EXO: Ajouter une propriété statique à la classe client. cette propriété doit compter le nombre de fois où la méthode getNom() est utilisée pour un objet de la classe client*/
$c1 = new Client;
$c1->setNom("Targaryan");
$c1->getNom();
$c1->getNom();


echo "La famille " . $c1->getNom() . " est la famille légitime sur le trône de fer<br><br>";
echo "La méthode getNom() a été appelé " . Client::$cpt . " fois ";
