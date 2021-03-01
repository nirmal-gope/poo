<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    ajouterMessage("danger", "Erreur 403 - Accès interdit");
    redirection("index.php");
}

$abonnes = selectAll("abonne");
$livres = selectAll("livre");

if( $_POST ){
    extract($_POST);

    if( empty($abonne_id) ){
        ajouterMessage("danger", "Choisissez un abonné");
    }
    if( empty($livre_id) ){
        ajouterMessage("danger", "Choisissez un livre");
    }
    if( empty($date_emprunt) ){
        ajouterMessage("danger", "Choisissez une date");
    }

    if( !messages("danger") ){
        if( !selectById("abonne", $abonne_id) ){
            ajouterMessage("danger", "Il n'y a pas d'abonné avec cet identifiant");
        }
        if( !selectById("livre", $livre_id) ){
            ajouterMessage("danger", "Il n'y a pas de livre avec cet identifiant");
        }

        if( !messages("danger") ){
            $pdostatement = $pdo->prepare("INSERT INTO emprunt (abonne_id, livre_id, date_emprunt) VALUES (:abonne_id, :livre_id, :date_emprunt)");
            $pdostatement->bindValue(":abonne_id", $abonne_id);
            $pdostatement->bindValue(":livre_id", $livre_id);
            $pdostatement->bindValue(":date_emprunt", $date_emprunt);

            if( $pdostatement->execute() ){
                ajouterMessage("success", "Nouvel emprunt enregistré");
                redirection("emprunt_liste.php");
            }
        }
    }
}

include "vues/header.html.php";
include "vues/form_emprunt.html.php";
include "vues/footer.html.php";