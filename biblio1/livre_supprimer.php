<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    ajouterMessage("danger", "Accès interdit !");
    redirection("./");
}

extract($_GET);
if( !empty($id) ){
    $livre = selectById("livre", $id);
    if( $livre ){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $resultat = $pdo->exec("DELETE FROM livre WHERE id = $id");
            if($resultat){
                ajouterMessage("success", "Le lilvre a bien été supprimé");
            } else {
                ajouterMessage("danger", "Erreur lors de la suppression");
            }
            redirection("livre_liste.php");
        }

    } else {
        ajouterMessage("danger", "Il n'y a pas de livre ayant l'identifiant $id"); 
        redirection("livre_liste.php");
    }

} else {
    echo "erreur 404 !";
    exit;
}

include "vues/header.html.php";

$titre = "Supprimer le livre n°$id";
$mode = "suppression";
include "vues/form_livre.html.php";

include "vues/footer.html.php";
