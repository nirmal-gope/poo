<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}



$pdostatement = $pdo->query("SELECT * FROM abonne");
if( $pdostatement && $pdostatement->rowCount() > 0 ){
    // La méthode fetchAll() pour récupérer toutes les lignes de la requête
    // PDO::FETCH_ASSOC signifie qu'on récupère les lignes sous forme d'array
    $abonnes = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>"; var_dump($abonnes); echo "</pre>";
}

?> 



<?php 
include "vues/header.html.php";
include "vues/abonne/table.html.php";
include "vues/footer.html.php"; ?>