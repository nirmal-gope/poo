<?php

include "includes/init.inc.php";
include "Controleurs/AbonneControleur.php";
include "Controleurs/LivreControleur.php";
include "vues/accueil/index.html.php";

// URL ?controleur=abonne&methode=liste
if ($_GET) {
    if (!empty($_GET["controleur"])) {
        $nomControleur = $_GET["controleur"];
    } else {
        $nomControleur = "accueil";
    }

    if (!empty($_GET["methode"])) {
        $methode = $_GET["methode"];
    } else {
        $methode = "liste";
    }

    $id = !empty($_GET["id"]) ? $_GET["id"] : null;
}

$classeControleur = ucfirst($nomControleur) . "Controleur";
/*
ex: $classeControleur = "AbonneControleur"
ucfirst : met la 1er lettre d'une chîne de caractère en majuscule
*/
$controleur = new $classeControleur; //ex : $controleur est un objet de la classe AbonneControleur
$controleur->$methode($id); // $abonneControleur->liste()




// include "vues/header.html.php";
// $pdostatement = $pdo->query("SELECT * FROM livre");
// $livres = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
// $livresNonRendus = livresNonRendus();
// include "vues/index.html.php";
// include "vues/footer.html.php";
