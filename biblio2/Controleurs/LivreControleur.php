<?php
namespace Controleurs;
/* On utilise 'use' suivi du nom complet d'une classe pour ne pas être obligé
    de nommer entiièrement la classe quand on en a besoin. C'est comme si on donnait
    un alias à la classe. 
   D'ailleurs, si on ajoute le mot-clé 'as' on peut définir
    un alias différent à cette classe. Cet alias ne fonctionne que dans le fichier
    actuel */
use Modeles\LivreModele as LM;
use Modeles\Entites\Livre;

class LivreControleur extends BaseControleur{

    public function liste(){
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
            redirection("index.php");
        }
        // $livreModele = new \Modeles\LivreModele;
        $livreModele = new LM;
        $livres = $livreModele->selectAll();
        
        // return $this->rendu("livre/table.html.php", [ "livres" => $livres ]);
        return $this->rendu("livre/table.html.php", compact("livres"));
    }

    public function ajouter()
    {
        if (!isAdmin()) {
            ajouterMessage("danger", "Accès interdit !");
            redirection("index.php");
        }
        if ($_POST) {
            extract($_POST);
            if (!empty($titre) && !empty($auteur)) {
                // CONTROLE DES CHAMPS DU FORMULAIRE
                if (strlen($titre) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le titre ne doit pas dépasser 50 caractères";
                }
                if (strlen($auteur) < 2 || strlen($auteur) > 50) {
                    $_SESSION["messages"]["danger"][] = "L'auteur doit comporter entre 2 et 50 caratères";
                }
                // Si il n'y a pas de messages d'erreur, mon formulaire est valide
                if (empty($_SESSION["messages"]["danger"])) {
                    $couverture = null;
                    if( !empty($_FILES["couverture"]["name"]) ){
                        // La fonction uniqid() permet de générer un string unique 
                        $nomFichier = uniqid() . $_FILES["couverture"]["name"];
                        // __DIR__ est une constante magique : la valeur est le chemin complet du dossier
                        //          dans lequel se trouve le fichier actuel
                        $dossier = __DIR__ . "/../images";
                        // La fonction copy($source, $destination) copie un fichier $source vers un autre fichier $destination
                        $imageSaved = copy($_FILES["couverture"]["tmp_name"], $dossier . "/" . $nomFichier);
                        if($imageSaved) {
                            $_SESSION["messages"]["success"][] = "L'image a bien été uploadée";
                            $couverture = $nomFichier;
                        } else {
                            $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement de l'image";
                        }
                    }
                    $livreModele = new LM;
                    $livre = new Livre;
                    $livre->setTitre($titre);
                    $livre->setAuteur($auteur);
                    $livre->setCouverture($couverture);
                    $resultat = $livreModele->insertInto($livre);

                    if($resultat){
                        $_SESSION["messages"]["success"][] = "Le nouveau livre a bien été ajouté ";
                        redirection( lien("livre", "liste") );
                    } else {
                        $_SESSION["messages"]["danger"][] = "Erreur lors de l'insertion en bdd";
                    }
                }
            } else {
                $_SESSION["messages"]["danger"][] = "Veuillez renseigner les champs obligatoires";
            }
        }
        
        include "vues/header.html.php";
        include "vues/livre/form.html.php";
        include "vues/footer.html.php";
    }

    public function modifier(int $id){
        if (!isAdmin()) {
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }
        $livreModele = new LM;
        $livre = $livreModele->selectById($id);
        if ($livre !== false) {
            if ($_POST) {
                extract($_POST);
                // CONTROLE DES CHAMPS DU FORMULAIRE
                if(empty($titre)) {
                    ajouterMessage("danger", "Le titre est obligatoire");
                } else {
                    $titre = trim($titre);
                    if (strlen($titre) > 50) {
                        ajouterMessage("danger", "Le titre ne doit pas dépasser 50 caractères");
                    }
                }
                if(empty($auteur)) {
                    ajouterMessage("danger", "L'auteur' est obligatoire");
                } else {
                    $auteur = trim($auteur);
                    if (strlen($auteur) < 2 || strlen($auteur) > 50) {
                        ajouterMessage("danger", "L'auteur doit comporter entre 2 et 50 caratères");
                    }
                }
                // Si il n'y a pas de messages d'erreur, mon formulaire est valide
                if (empty(messages("danger"))) {
                    extract($_FILES["couverture"]);
                    $couverture = $livre->getCouverture();
                    if( !empty($name) ){
                        $positionPoint = strrpos($name, ".", -1);
                        $extension = substr($name, $positionPoint);
                        $nomFichier = substr($name, 0, strlen($name) - $positionPoint);
                        $nomFichier = $nomFichier . "_" . time() . $extension;
                        $dossier = __DIR__ . "/../images";
                        $imageSaved = copy($tmp_name, $dossier . "/" . $nomFichier);
                        if($imageSaved) {
                            ajouterMessage("success", "L'image a bien été téléversée");
                            $couverture = $nomFichier;
                        } else {
                            ajouterMessage("danger", "Erreur lors de l'enregistrement de l'image");
                        }
                    }

                    $livre->setTitre($titre);
                    $livre->setAuteur($auteur);
                    $livre->setCouverture($couverture);
                    $resultat = $livreModele->update($livre);

                    if($resultat){
                        ajouterMessage("success", "Le livre a bien été modifié ");
                        redirection( lien("livre", "liste") );
                    } else {
                        ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");
                    }
                }
            }
        }
            
        $titre = "Modifier le livre n°$id";
        include "vues/header.html.php";
        include "vues/livre/form.html.php";
        include "vues/footer.html.php";
    }

    public function supprimer(int $id)
    {
        if( !isAdmin() ){
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }
        $livreModele = new LM;
        $livre = $livreModele->selectById($id);
        if( $livre ){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
               
                $resultat = $livreModele->delete($livre);
                if($resultat){
                    ajouterMessage("success", "Le livre a bien été supprimé");
                } else {
                    ajouterMessage("danger", "Erreur lors de la suppression");
                }
                redirection( lien("livre", "liste") );
            }
        } else {
            ajouterMessage("danger", "Il n'y a pas de livre ayant l'identifiant $id"); 
            redirection( lien("livre", "liste") );
        }
        
        
        include "vues/header.html.php";
        
        $titre = "Supprimer le livre n°$id";
        $mode = "suppression";
        include "vues/livre/form.html.php";       
        include "vues/footer.html.php";
    }
}