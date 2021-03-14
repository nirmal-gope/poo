<?php
namespace Controleurs;

use Modeles\AbonneModele;

class UserControleur extends BaseControleur{
    public function connexion()
    {
        if( $_POST ){
            extract($_POST);
            if( !empty($pseudo) && !empty($mdp) ){
                $abonneModele = new AbonneModele;
                $abonne = $abonneModele->selectByPseudo($pseudo);
                if($abonne){
                    if( password_verify($mdp, $abonne->getMdp()) ){
                        $_SESSION["messages"]["success"][]  = "Bonjour " . $abonne->getPseudo() .  ", vous êtes connecté";
                        $_SESSION["abonne"] = $abonne;
                        redirection( lien("user", "profil") );
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
        include "vues/user/form.html.php";
        include "vues/footer.html.php";
    }

    public function deconnexion(){
        session_destroy();
        redirection("./");
    }

    public function profil(){
        $abonne = isConnected();
        if( empty($abonne) ){
            header("Location: connexion.php");
            exit;
        }
        $emprunts =  EmpruntsParAbonneId($abonne->getId());
        include "vues/header.html.php";
        include "vues/user/profil.html.php";
        include "vues/footer.html.php";
    }
}
