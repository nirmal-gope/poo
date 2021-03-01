<?php
include "includes/init.inc.php";
if( $abonneConnecte = isConnected() ) {
    if( !empty($_GET["id"]) ){
        $id = $_GET["id"]; //extract($_GET)
        $livre = selectById("livre", $id);
        // L'utilisateur connecté veut emprunter ce livre à la date d'aujourd'hui
        $aujourdhui = date("Y-m-d");
        $idAbonne = $abonneConnecte["id"];
        $resultat = $pdo->exec("INSERT INTO emprunt (date_emprunt, abonne_id, livre_id)
                                    VALUES ('$aujourdhui', $idAbonne, $id)");
        if($resultat){
            ajouterMessage("success", "Votre emprunt a bien été enregistré");
        } else {
            ajouterMessage("danger", "Erreur BDD");    
        }
    } else {
        ajouterMessage("danger", "Erreur 404");
    }
} else {
    ajouterMessage("danger", "Erreur 403");
}
redirection("index.php");
