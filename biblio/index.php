<?php

include_once "includes/init.inc.php";

// URL ?controleur=abonne&methode=liste
if( $_GET ){
    if( !empty($_GET["controleur"]) ){
        $nomControleur = $_GET["controleur"];
    } else {
        $nomControleur = "accueil";
    }

    if( !empty($_GET["methode"]) ) {
        $methode = $_GET["methode"];
    } else {
        $methode = $nomControleur== "accueil" ? "index" : "liste";
    }

    $id = !empty($_GET["id"]) ? $_GET["id"] : null;
} else {
    // s'il n'a pas de Query String dans l'url, on affiche la page d'accueil 
    $nomControleur = "accueil";
    $methode = "index";
    $id = null;
}

$classeControleur = "Controleurs\\" . ucfirst($nomControleur) . "Controleur";  //ex: $classeControleur = "Controleurs\AbonneControleur"
// ucfirst : met la 1er lettre d'une chaîne de caratère en majuscule
$controleur = new $classeControleur; // ex: $controleur est un objet de la classe AbonneControleur
$controleur->$methode($id);              // $abonneControleur->liste()  

