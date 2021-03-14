<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}

if( $_POST ){
    extract($_POST);    
    /*
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];

    La fonction extract($tableau) crée autant de variables qu'il y a d'indices dans un tableau associatif
    (rappel : un tableau associatif a des indices en string au lieu des indices numériques)
    Les variables auront le nom des indices et la valeur correspondante dans le tableau.
    extract ne peut être utilisé qu'avec un tableau associatif parce qu'on NE PEUT PAS DÉCLARER des variables
    commençant par un chiffre.
    */
    $msgErreur = "";
    if (isset($pseudo) && isset($mdp)){
        /* La fonction isset() renvoie TRUE si la variable passée en paramètre existe */
        if( strlen($pseudo) >= 4 && strlen($pseudo) <= 30 ){
            if(strlen($mdp) >= 4 && strlen($mdp) <= 10){
                $pseudo = htmlentities(addslashes($pseudo));  // Attention : htmlentities et addslashes modifie $pseudo et donc sa taille
                // Il NE FAUT PAS utiliser ces fonctions sur le mot de passe
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                // $requete = $pdo->exec("INSERT INTO abonne (pseudo, mdp) VALUES ('$pseudo', '$mdp')");

                /* Une requête préparée est une requête qui n'est pas exécutée immédiatement. On peut utiliser des paramètres dans ce 
                    genre de requête SQL. Un paramètre est noté : suivi du nom du paramètre  */
                $pdostatement = $pdo->prepare("INSERT INTO abonne (pseudo, mdp, niveau) VALUES (:pseudo, :mdp, :niveau)");
                $pdostatement->bindValue(":pseudo", $pseudo);
                $pdostatement->bindValue(":mdp", $mdp);
                $pdostatement->bindValue(":niveau", $niveau);

                try {
                    $resultat = $pdostatement->execute();
                } catch (\Throwable $th) {
                    $_SESSION["messages"]["danger"][] = "Erreur BDD";

                }

                /*
                    En PHP, lorsqu'une valeur (ou variable) doit être transformée en booléen (par exemple une condition pour 'if')
                    selon le type de cette valeur, certaines valeurs sont considérées comme FALSE :
                    numérique   : 0
                    string      : ""
                    array       : []
                    boolean     : FALSE
                    ATTENTION : un objet n'est jamais considéré comme FALSE
                */
                if( !empty($resultat) ){
                    $_SESSION["messages"]["success"][]  = "Le nouvel abonné a bien été ajouté dans la base de données";
                    header("Location: abonne_liste.php");
                    exit;
                } else {
                    $_SESSION["messages"]["danger"][] = "Erreur lors de l'insertion en BDD";
                }
            } else {
                $_SESSION["messages"]["danger"][]  = "Le mot de passe doit comporter entre 4 et 10 caractères";
            }
        } else {
            $_SESSION["messages"]["danger"][]  = "Le pseudo doit comporter entre 4 et 30 caractères";
        }
    } else {
        $_SESSION["messages"]["danger"][]  = "Formulaire invalide";
    }
}

include "vues/header.html.php";
include "vues/form_abonne.html.php";
include "vues/footer.html.php";

