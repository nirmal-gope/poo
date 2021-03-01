<?php
include "includes/init.inc.php";
if (!isAdmin()) {
    ajouterMessage("danger", "Accès interdit !");
    redirection("./");
}

extract($_GET);
if (!empty($id)){
    $emprunt = selectById("emprunt", $id);
    if ($emprunt) {
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
                    $pdostatement = $pdo->prepare("UPDATE emprunt 
                                                   SET abonne_id = :abonne_id, livre_id = :livre_id, date_emprunt = :date_emprunt, date_retour = :date_retour
                                                   WHERE id = :id");
                    $pdostatement->bindValue(":abonne_id", $abonne_id);
                    $pdostatement->bindValue(":livre_id", $livre_id);
                    $pdostatement->bindValue(":date_emprunt", $date_emprunt);
                    $pdostatement->bindValue(":date_emprunt", $date_retour ?? null);
        
                    if( $pdostatement->execute() ){
                        ajouterMessage("success", "Emprunt modifié");
                        redirection("emprunt_liste.php");
                    }
                }
            }
        }
    } else {
        echo "erreur 404 !";
        exit;
    }

} else {
    echo "erreur 404 !";
    exit;
}

$titre = "Modfifier l'emprunt n°$id";
$abonnes = selectAll("abonne");
$livres = selectAll("livre");

include "vues/header.html.php";
include "vues/form_emprunt.html.php";
include "vues/footer.html.php";
