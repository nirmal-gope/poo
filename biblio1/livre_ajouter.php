<?php
include "includes/init.inc.php";
if (!isAdmin()) {
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}
if ($_POST) {
    extract($_POST);
    if (!empty($titre) && !empty($auteur)) {
        // CONTROLE DES CHAMPS DU FORMULAIRE
        if (strlen($titre) > 50) {
            $_SESSION["messages"]["danger"][] = "Le titre ne doit pas dépasser 50 caractères";
        }
        if (strlen($auteur) < 2 || strlen($auteur) > 50) {
            $_SESSION["messages"]["danger"][] = "L'auteur doit comporter entre 2 et 50 caratères";
        }
        // Si il n'y a pas de messages d'erreur, mon formulaire est valide
        if (empty($_SESSION["messages"]["danger"])) {
            if( !empty($_FILES["couverture"]["name"]) ){
                // La fonction uniqid() permet de générer un string unique 
                $nomFichier = uniqid() . $_FILES["couverture"]["name"];
                // __DIR__ est une constante magique : la valeur est le chemin complet du dossier
                //          dans lequel se trouve le fichier actuel
                $dossier = __DIR__ . "/images";
                // La fonction copy($source, $destination) copie un fichier $source vers un autre fichier $destination
                $imageSaved = copy($_FILES["couverture"]["tmp_name"], $dossier . "/" . $nomFichier);
                if($imageSaved) {
                    $_SESSION["messages"]["success"][] = "L'image a bien été uploadée";
                    $couverture = $nomFichier;
                } else {
                    $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement de l'image";
                }
            }
            $pdostatement = $pdo->prepare("INSERT INTO livre (titre, auteur, couverture) VALUES (:titre, :auteur, :couverture)");
            $pdostatement->bindValue(":titre", $titre);
            $pdostatement->bindValue(":auteur", $auteur);
            $pdostatement->bindValue(":couverture", $couverture ?? null);
            $resultat = $pdostatement->execute();
            if($resultat){
                $_SESSION["messages"]["success"][] = "Le nouveau livre a bien été ajouté ";
                redirection("livre_liste.php");
            } else {
                $_SESSION["messages"]["danger"][] = "Erreur lors de l'insertion en bdd";
            }
        }
    } else {
        $_SESSION["messages"]["danger"][] = "Veuillez renseigner les champs obligatoires";
    }
}

include "vues/header.html.php";
include "vues/form_livre.html.php";
include "vues/footer.html.php";
