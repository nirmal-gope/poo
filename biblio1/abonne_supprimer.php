<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}

if( !empty($_GET["id"]) ){
    extract($_GET);
    $pdostatement = $pdo->prepare("SELECT * FROM abonne WHERE id = :id");
    $pdostatement->bindValue(":id", $id);
    $resultat = $pdostatement->execute();
    if( $resultat && $pdostatement->rowCount() == 1 ){
        $abonne = $pdostatement->fetch(PDO::FETCH_ASSOC);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $resultat = $pdo->exec("DELETE FROM abonne WHERE id = $id");
            if($resultat){
                $_SESSION["messages"]["success"][] = "L'abonné a bien été supprimé";
            } else {
                $_SESSION["messages"]["danger"][] = "Erreur lors de la suppression";
            }
            redirection("abonne_liste.php");
        }

    } else {
        $_SESSION["messages"]["danger"][] = "Il n'y a pas d'abonné ayant l'identifiant $id"; 
        redirection("abonne_liste.php");
    }

} else {
    echo "erreur 404 !";
    exit;
}

include "vues/header.html.php";

$titre = "Supprimer l'abonné n°$id";
$mode = "suppression";
include "vues/form_abonne.html.php";

include "vues/footer.html.php";
