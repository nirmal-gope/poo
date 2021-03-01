<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    ajouterMessage("danger", "Erreur 403 - Accès interdit");
    redirection("./");
}
$emprunts = selectAll("emprunt");

// Affichage
include "vues/header.html.php";
echo "<h1>Liste des emprunts</h1>";
include "vues/table_emprunt.html.php";
include "vues/footer.html.php";
