<?php
namespace Controleurs;

use Modeles\EmpruntModele;

class EmpruntControleur{
    public function liste()
    {
        if( !isAdmin() ){
            ajouterMessage("danger", "Erreur 403 - Accès interdit");
            redirection("./");
        }
        $emprunts = (new EmpruntModele)->selectEmprunts();
        
        // Affichage
        include "vues/header.html.php";
        echo "<h1>Liste des emprunts</h1>";
        include "vues/emprunt/table.html.php";
        include "vues/footer.html.php";
    }

    public function ajouter()
    {
        if( !isAdmin() ){
            ajouterMessage("danger", "Erreur 403 - Accès interdit");
            redirection("index.php");
        }
        
        $abonnes = selectAll("abonne");
        $livres = selectAll("livre");
        
        if( $_POST ){
            extract($_POST);
        
            if( empty($abonne_id) ){
                ajouterMessage("danger", "Choisissez un abonné");
            }
            if( empty($livre_id) ){
                ajouterMessage("danger", "Choisissez un livre");
            }
            if( empty($date_emprunt) ){
                ajouterMessage("danger", "Choisissez une date");
            }
        
            if( !messages("danger") ){
                if( !selectById("abonne", $abonne_id) ){
                    ajouterMessage("danger", "Il n'y a pas d'abonné avec cet identifiant");
                }
                if( !selectById("livre", $livre_id) ){
                    ajouterMessage("danger", "Il n'y a pas de livre avec cet identifiant");
                }
        
                if( !messages("danger") ){
                    $pdostatement = $pdo->prepare("INSERT INTO emprunt (abonne_id, livre_id, date_emprunt) VALUES (:abonne_id, :livre_id, :date_emprunt)");
                    $pdostatement->bindValue(":abonne_id", $abonne_id);
                    $pdostatement->bindValue(":livre_id", $livre_id);
                    $pdostatement->bindValue(":date_emprunt", $date_emprunt);
        
                    if( $pdostatement->execute() ){
                        ajouterMessage("success", "Nouvel emprunt enregistré");
                        redirection( lien("emprunt", "liste") );
                    }
                }
            }
        }
        
        include "vues/header.html.php";
        include "vues/emprunt/form.html.php";
        include "vues/footer.html.php";
    }

    public function modifier(int $id)
    {
        if (!isAdmin()) {
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }
        
        extract($_GET);
        if (!empty($id)){
            $emprunt = selectById("emprunt", $id);
            if ($emprunt) {
                if( $_POST ){
                    extract($_POST);
                
                    if( empty($abonne_id) ){
                        ajouterMessage("danger", "Choisissez un abonné");
                    }
                    if( empty($livre_id) ){
                        ajouterMessage("danger", "Choisissez un livre");
                    }
                    if( empty($date_emprunt) ){
                        ajouterMessage("danger", "Choisissez une date");
                    }
                
                    if( !messages("danger") ){
                        if( !selectById("abonne", $abonne_id) ){
                            ajouterMessage("danger", "Il n'y a pas d'abonné avec cet identifiant");
                        }
                        if( !selectById("livre", $livre_id) ){
                            ajouterMessage("danger", "Il n'y a pas de livre avec cet identifiant");
                        }
                
                        if( !messages("danger") ){
                            $pdostatement = $pdo->prepare("UPDATE emprunt 
                                                           SET abonne_id = :abonne_id, livre_id = :livre_id, date_emprunt = :date_emprunt, date_retour = :date_retour
                                                           WHERE id = :id");
                            $pdostatement->bindValue(":abonne_id", $abonne_id);
                            $pdostatement->bindValue(":livre_id", $livre_id);
                            $pdostatement->bindValue(":date_emprunt", $date_emprunt);
                            $pdostatement->bindValue(":date_emprunt", $date_retour ?? null);
                
                            if( $pdostatement->execute() ){
                                ajouterMessage("success", "Emprunt modifié");
                                redirection( lien("emprunt", "liste") );
                            }
                        }
                    }
                }
            } else {
                echo "erreur 404 !";
                exit;
            }
        
        } else {
            echo "erreur 404 !";
            exit;
        }
        
        $titre = "Modfifier l'emprunt n°$id";
        $abonnes = selectAll("abonne");
        $livres = selectAll("livre");
        
        include "vues/header.html.php";
        include "vues/emprunt/form.html.php";
        include "vues/footer.html.php";
    }

    public function supprimer(int $id){
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }
        
        extract($_GET);
        if( !empty($id) ){
            $emprunt = selectById("emprunt", $id);
            if( $emprunt ){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $resultat = $pdo->exec("DELETE FROM emprunt WHERE id = $id");
                    if($resultat){
                        ajouterMessage("success", "L'emprunt a bien été supprimé");
                    } else {
                        ajouterMessage("danger", "Erreur lors de la suppression");
                    }
                    redirection( lien("emprunt", "liste") );
                }
        
            } else {
                ajouterMessage("danger", "Il n'y a pas de emprunt ayant l'identifiant $id"); 
                redirection(lien("emprunt", "liste"));
            }
        
        } else {
            echo "erreur 404 !";
            exit;
        }
        
        include "vues/header.html.php";
        
        $titre = "Supprimer l'emprunt n°$id";
        $mode = "suppression";
        include "vues/emprunt/form.html.php";
        
        include "vues/footer.html.php";
    }
}