<?php
include "includes/init.inc.php";

if ($_POST) {
    extract($_POST);
    if (!empty($pseudo) && !empty($mdp)) {
        $pdostatement = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $pdostatement->bindValue(":pseudo", $pseudo);
        $resultat = $pdostatement->execute();
        if ($resultat && $pdostatement->rowCount()) {
            $membre = $pdostatement->fetch(PDO::FETCH_ASSOC);
            if (password_verify($mdp, $membre["mdp"])) {
                $_SESSION["messages"]["success"][]  = "Bonjour " . $membre["pseudo"] .  ", vous êtes connecté";
                $_SESSION["membre"] = $membre;
                redirection("profil.php");
            } else {
                $_SESSION["messages"]["danger"][] = "Le mot de passe ne correspond pas !";
            }
        } else {
            $_SESSION["messages"]["danger"][] = "Le pseudo n'existe pas !";
        }
    } else {
        $_SESSION["messages"]["danger"][] = "Veuillez saisir le pseudo et le mot de passe !";
    }
}

include "vues/header.html.php";
include "vues/form_connexion.html.php";
include "vues/footer.html.php";
