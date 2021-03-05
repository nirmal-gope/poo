<?php
/* Le namespace permet de préciser le nom d'une classe. Quand on ajoute un namespace le nom complet de la classe
    est le namespace suivi de \ suivi du nom de la classe. Par exemple :  Controleurs\AbonneControleur
    Pour faciliter le travail de l'autoload, le namespace va correspondre au chemin du dossier dans lequel se trouve
    le fichier de la classe (exemple: Controleurs/AbonneControleur.php)
*/
namespace Controleurs;

use Modeles\AbonneModele;
use PDO;

class AbonneControleur{
    public function liste(){
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
            redirection("index.php");
        }

        /* Je peux instancier un objet et l'utiliser directement sans passer 
            par une variable. Il faut mettre l'instanciation entre ()
            par exemple : (new Livre)->getTitre();
        */
        $abonnes = (new AbonneModele)->selectAll();

        include "vues/header.html.php";
        include "vues/abonne/table.html.php";
        include "vues/footer.html.php";

    }

    public function ajouter(){
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
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
                        if ( !insertInto("abonne", compact("pseudo", "mdp", "niveau")) ){
                            ajouterMessage("danger", "Erreur lors de l'insertion en base de données");
                        } else {
                            ajouterMessage("success", "Le nouvel abonné a bien été ajouté dans la base de données");
                            header("Location: ?methode=liste");
                            exit;      
                        }
                    } else {
                        ajouterMessage("danger", "Le mot de passe doit comporter entre 4 et 10 caractères");
                    }
                } else {
                    ajouterMessage("danger", "Le pseudo doit comporter entre 4 et 30 caractères");
                }
            } else {
                ajouterMessage("danger", "Formulaire invalide");
            }
        }
        
        include "vues/header.html.php";
        include "vues/abonne/form.html.php";
        include "vues/footer.html.php";
    }

    public function modifier(){
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }
        
       
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
                $abonne = $pdostatement->fetch(\PDO::FETCH_ASSOC);
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
                                    ajouterMessage("danger", $msgErreur);
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
                                ajouterMessage("danger", $msgErreur);
                            }
                        } else {
                            $msgErreur = "Le pseudo doit comporter entre 4 et 30 caractères";
                            ajouterMessage("danger", $msgErreur);
                        }
                    } else {
                        $msgErreur = "Le pseudo ne peut pas être vide";
                        ajouterMessage("danger", $msgErreur);
                    }
                }
            }
        
        } else {
            echo "erreur 404 !";
            exit;
        }
        
        include "vues/header.html.php";
        
        $titre = "Modifier l'abonné n°$id";
        include "vues/abonne/form.html.php";
        include "vues/footer.html.php";
    }

    public function supprimer(){
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
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
                        ajouterMessage("danger", "Erreur lors de la suppression");
                    }
                    redirection("abonne_liste.php");
                }
        
            } else {
                ajouterMessage("danger", "Il n'y a pas d'abonné ayant l'identifiant $id"); 
                redirection("abonne_liste.php");
            }
        
        } else {
            echo "erreur 404 !";
            exit;
        }
        
        include "vues/header.html.php";
        
        $titre = "Supprimer l'abonné n°$id";
        $mode = "suppression";
        include "vues/abonne/form.html.php";
        
        include "vues/footer.html.php";
    }

    public function test()
    {
        include "vues/header.html.php";
        echo "page test";
        include "vues/footer.html.php";
    }
}