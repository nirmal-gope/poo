<?php
include "includes/init.inc.php";
if (!isAbonne()) {
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}

if (!empty($_GET["id"])) {
    extract($_GET);
    $pdostatement = $pdo->prepare("SELECT * FROM voitures WHERE id = :id");
    $pdostatement->bindValue(":id", $id);
    $resultat = $pdostatement->execute();
    if ($resultat && $pdostatement->rowCount() == 1) {
        $voiture = $pdostatement->fetch(PDO::FETCH_ASSOC);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $resultat = $pdo->exec("DELETE FROM voitures WHERE id = $id");
            if ($resultat) {
                $_SESSION["messages"]["success"][] = "L'annonce a bien été supprimé";
            } else {
                $_SESSION["messages"]["danger"][] = "Erreur lors de la suppression";
            }
            redirection("gestion_voitures.php");
        }
    } else {
        $_SESSION["messages"]["danger"][] = "Il n'y a pas d'annonce ayant l'identifiant $id";
        // redirection("gestion_voitures.php");
    }
} else {
    echo "erreur 404 !";
    exit;
}
include "vues/header.html.php";
$titre = "Supprimer l'annonce $id";
$mode = "suppression";
include "vues/form_voiture.html.php";
include "vues/footer.html.php";
