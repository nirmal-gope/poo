<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("./");
}

// Récupérer l'abonné dont l'identifiant est dans l'URL (donc avec $_GET)

/* QUERY STRING : nomfichier.php?indice=valeur&indice2=valeur2
        $_GET["indice"] vaut "valeur";
        $_GET["indice2] vaut "valeur2";  
        
$tableau = [ "id" => "" ]
    isset($tableau["id"]) est égal à TRUE
    isset($tableau["autre indice"]) est égal à FALSE
    
    empty($tableau["id"]) est égal à TRUE
    empty($tableau["autre indice"]) est égal à TRUE

*/

if( !empty($_GET["id"]) ){
    extract($_GET);
    $pdostatement = $pdo->prepare("SELECT * FROM abonne WHERE id = :id");
    $pdostatement->bindValue(":id", $id);
    $resultat = $pdostatement->execute();
    if( $resultat && $pdostatement->rowCount() == 1 ){
        $abonne = $pdostatement->fetch(PDO::FETCH_ASSOC);
        // UPDATE abonne SET pseudo = "anakin", mdp = '$2y$qsfdsfqfqfsd' WHERE id = 2
        if( $_POST ){
            extract($_POST);
            if( !empty($pseudo) ){
                if( strlen($pseudo) >= 4 && strlen($pseudo) <= 30 ){
                    $texteRequete = "UPDATE abonne SET pseudo = :pseudo, niveau = :niveau";
                    
                    if(!empty($mdp)) {
                        if (strlen($mdp) >= 4 && strlen($mdp) <= 10){
                            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                            $texteRequete .= ", mdp = :mdp";
                        } else {
                            $msgErreur = "Le mot de passe doit contenir entre 4 et 10 caractères";
                            $_SESSION["messages"]["danger"][] = $msgErreur;
                            $mdp = "";
                        }
                    }

                    $texteRequete .= " WHERE id = :id";

                    $pdostatement = $pdo->prepare($texteRequete);
                    $pdostatement->bindValue(":pseudo", $pseudo);
                    $pdostatement->bindValue(":niveau", $niveau);
                    $pdostatement->bindValue(":id", $id);
                    if(!empty($mdp)){
                        $pdostatement->bindValue(":mdp", $mdp);
                    }
                    $resultat = $pdostatement->execute();
                    if( $resultat ){
                        $msgSucces = "L'abonné n°$id a bien été modifié";
                        // $_SESSION["messages"] = [];
                        $_SESSION["messages"]["success"][] = $msgSucces;
                        header("Location: abonne_liste.php");
                        exit;
                    } else {
                        $msgErreur = "Erreur BDD";
                        $_SESSION["messages"]["danger"][] = $msgErreur;
                    }
                } else {
                    $msgErreur = "Le pseudo doit comporter entre 4 et 30 caractères";
                    $_SESSION["messages"]["danger"][] = $msgErreur;
                }
            } else {
                $msgErreur = "Le pseudo ne peut pas être vide";
                $_SESSION["messages"]["danger"][] = $msgErreur;
            }
        }
    }

} else {
    echo "erreur 404 !";
    exit;
}

include "vues/header.html.php";

$titre = "Modifier l'abonné n°$id";
include "vues/form_abonne.html.php";

include "vues/footer.html.php";
