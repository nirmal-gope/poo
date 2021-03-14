<?php
namespace Controllers;
use Models\MembreModel as MM;
use Models\Entities\Membre;

class MembreController extends BaseController{
    public function list(){

        $membreModel = new MM;
        $controllers = $membreModel->selectAll();
        return $this->render("membre/table.html.php", compact("controllers"));
    }
    public function ajouter(){
        if($_POST){
            extract($_POST);
            if(isset($pseudo) && isset($mdp) && isset($nom) && isset($prenom) && isset($email)&& isset($telephone) && isset($statut)){
                if(strlen($pseudo) >= 4 && strlen($pseudo) <= 30){
                    if(strlen($mdp) >= 6 && strlen($mdp) <= 15){
                        $pseudo = htmlentities(addslashes($pseudo));
                        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

                        $membreModel = new MM;
                        $membre = new Membre;
                        $membre ->setPseudo($pseudo);
                        $membre ->setMdp($mdp);
                        $membre ->setNom($nom);
                        $membre ->setPrenom($prenom);
                        $membre ->setEmail($email);
                        $membre ->setTelephone($telephone);
                        $membre ->setStatut($statut);

                        $resultat = $MembreModele->insertInto($membre);

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
        return $this->render("/membre/form.html.php");


    }

    public function modifier(int $id){
        $MembreModel = new MM;
        $membre = $MembreModel->selectById($id);
        if ($membre !== false) {
            if ($_POST) {
                extract($_POST);

                if (empty($pseudo)) {
                    ajouterMessage("danger", "Le pseudo est obligatoire");
                } else {
                    $pseudo = trim($pseudo);
                    if (strlen($pseudo) > 50) {
                        ajouterMessage("danger", "Le pseudone doit pas dépasser 50 caractères");
                    }
                }
                if (empty($mdp)) {
                    ajouterMessage("danger", "Mot de pass est obligatoire");
                } else {
                    if (strlen($pseudo) >= 4 && strlen($pseudo) <= 30) {
                        if (strlen($mdp) >= 6 && strlen($mdp) <= 15) {
                            $pseudo = htmlentities(addslashes($pseudo));
                            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                            ajouterMessage("danger", "Le mot de pass doit comporter entre § et 15 caratères");
                        }
                    }
                }
                if (empty($prenom)) {
                    ajouterMessage("danger", "Le prenom est obligatoire");
                } else {
                    $prenom = trim($prenom);
                    if (strlen($prenom) < 2 || strlen($prenom) > 50) {
                        ajouterMessage("danger", "Le prenom doit comporter entre 2 et 50 caratères");
                    }
                }
            }
        }
        $membre ->setPseudo($pseudo);
        $membre ->setMdp($mdp);
        $membre ->setNom($nom);
        $membre ->setPrenom($prenom);
        $membre ->setEmail($email);
        $membre ->setTelephone($telephone);
        $membre ->setStatut($statut);
        $resultat = $MembreModele->update($membre);

        if ($resultat) {
            ajouterMessage("success", "Le membre a bien été modifié ");
            redirection(lien("membre", "list"));
        } else {
            ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");
        }
        $titre = "Modifier le membre n°$id";
        return $this->render("/membre/form.html.php", ["membre" => $membre, "titre" => $titre,]);
    }
    public function supprimer(int $id){
        $MembreModele = new MM;
        $membre = $MembreModele->selectById($id);
        if ($membre) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $resultat = $MembreModele->delete($membre);
                if ($resultat) {
                    ajouterMessage("success", "Le membre a bien été supprimé");
                } else {
                    ajouterMessage("danger", "Erreur lors de la suppression");
                }
                redirection(lien("membre", "list"));
            }
        } else {
            ajouterMessage("danger", "Il n'y a pas de membre ayant l'identifiant $id");
            redirection(lien("membre", "list"));
        }


        $titre = "Supprimer le membre n°$id";
        return $this->render("/membre/form.html.php", ["membre" => $membre, "titre" => $titre,]);
        $mode = "suppression";

    }

}