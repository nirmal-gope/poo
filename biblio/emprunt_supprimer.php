<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    ajouterMessage("danger", "Accès interdit !");
    redirection("./");
}

extract($_GET);
if( !empty($id) ){
    $emprunt = selectById("emprunt", $id);
    if( $emprunt ){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $resultat = $pdo->exec("DELETE FROM emprunt WHERE id = $id");
            if($resultat){
                ajouterMessage("success", "L'emprunt a bien été supprimé");
            } else {
                ajouterMessage("danger", "Erreur lors de la suppression");
            }
            redirection("emprunt_liste.php");
        }

    } else {
        ajouterMessage("danger", "Il n'y a pas de emprunt ayant l'identifiant $id"); 
        redirection("emprunt_liste.php");
    }

} else {
    echo "erreur 404 !";
    exit;
}

include "vues/header.html.php";

$titre = "Supprimer l'emprunt n°$id";
$mode = "suppression";
include "vues/form_emprunt.html.php";

include "vues/footer.html.php";
