<?php

include 'includes/init.inc.php';
if($_POST){
    extract($_POST);
    if(isset($pseudo) && isset($mdp) && isset($nom) && isset($prenom) && isset($email)&& isset($telephone) && isset($statut)){
        if(strlen($pseudo) >= 4 && strlen($pseudo) <= 30){
            if(strlen($mdp) >= 6 && strlen($mdp) <= 15){
                $pseudo = htmlentities(addslashes($pseudo));
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                $pdostatement = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, telephone, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :telephone, :statut)");
                $pdostatement->bindValue(':pseudo', $pseudo);
                $pdostatement->bindValue(':mdp', $mdp);
                $pdostatement->bindValue(':nom', $nom);
                $pdostatement->bindValue(':prenom', $prenom);
                $pdostatement->bindValue(':email', $email);
                $pdostatement->bindValue(':telephone', $telephone);
                $pdostatement->bindValue(':statut', $statut);

                try {
                    $resultat = $pdostatement->execute();
                } catch (\Throwable $th) {
                    $_SESSION['messages']['danger'][] = 'Erreur BDD';
                }
                if(!empty($resultat)){
                    $_SESSION['messages']['success'][] = "Le nouvel $statut a bien été enregistré";
                    header('Location: profil.php');
                    exit;
                }else{
                    $_SESSION['messages']['danger'][] = "Erreur lors de l'insertion en BDD";

                }

            }else{
                $_session["messages"]["danger"][] = "Le mot de passe doit comporter entre 6 et 15 caractères";
            }
        }else{
            $_SESSION['messages']['danger'][] = 'Le pseudo, nom et prenom doit comporter entre 4 et 30 caractères';
        }

    }else{
        $_SESSION['messages']['danger'][] = 'Formulaire invalide';
    }

}


include 'vues/header.html.php';
include 'vues/form_inscription.html.php';
include 'vues/footer.html.php';
