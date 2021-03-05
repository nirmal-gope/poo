<?php

namespace Controleurs;

use Modeles\ConducteurModele as CM;
use Modeles\Entites\Conducteur;

class ConducteurControleur extends BaseControleur
{

    public function liste()
    {

        $ConducteurModele = new CM;
        $conducteurs = $ConducteurModele->selectAll();

        return $this->rendu("conducteur/table.html.php", compact("conducteurs"));
    }

    public function ajouter()
    {

        if ($_POST) {
            extract($_POST);
            if (!empty($prenom) && !empty($nom)) {

                if (strlen($prenom) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le prenom ne doit pas dépasser 50 caractères";
                }
                if (strlen($nom) < 2 || strlen($auteur) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le nom doit comporter entre 2 et 50 caratères";
                }

                $ConducteurModele = new CM;
                $conducteur = new Conducteur;
                $conducteur->setPrenom($prenom);
                $conducteur->setNom($nom);
                $resultat = $ConducteurModele->insertInto($conducteur);

                if ($resultat) {
                    $_SESSION["messages"]["success"][] = "Le nouveau conducteur a bien été ajouté ";
                    redirection(lien("conducteur", "liste"));
                } else {
                    $_SESSION["messages"]["danger"][] = "Erreur lors de l'insertion en bdd";
                }
            } else {
                $_SESSION["messages"]["danger"][] = "Veuillez renseigner les champs obligatoires";
            }
        }

        return $this->rendu("/conducteur/form.html.php");
    }

    public function modifier(int $id_conducteur)
    {

        $ConducteurModele = new CM;
        $conducteur = $ConducteurModele->selectById($id_conducteur);
        if ($conducteur !== false) {
            if ($_POST) {
                extract($_POST);
                if (empty($prenom)) {
                    ajouterMessage("danger", "Le prenom est obligatoire");
                } else {
                    $prenom = trim($prenom);
                    if (strlen($prenom) > 50) {
                        ajouterMessage("danger", "Le prenom ne doit pas dépasser 50 caractères");
                    }
                }
                if (empty($nom)) {
                    ajouterMessage("danger", "Le nom est obligatoire");
                } else {
                    $nom = trim($nom);
                    if (strlen($nom) < 2 || strlen($nom) > 50) {
                        ajouterMessage("danger", "Le nom doit comporter entre 2 et 50 caratères");
                    }
                }


                $conducteur->setPrenom($prenom);
                $conducteur->setNom($nom);
                $resultat = $ConducteurModele->update($conducteur);

                if ($resultat) {
                    ajouterMessage("success", "Le conducteur a bien été modifié ");
                    redirection(lien("conducteur", "liste"));
                } else {
                    ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");
                }
            }
        }


        $titre = "Modifier le conducteur n°$id_conducteur";
        return $this->rendu("/conducteur/form.html.php", ["conducteur" => $conducteur, "titre" => $titre,]);
    }

    public function supprimer(int $id_conducteur)
    {
        $ConducteurModele = new CM;
        $conducteur = $ConducteurModele->selectById($id_conducteur);
        if ($conducteur) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $resultat = $ConducteurModele->delete($conducteur);
                if ($resultat) {
                    ajouterMessage("success", "Le Conducteur a bien été supprimé");
                } else {
                    ajouterMessage("danger", "Erreur lors de la suppression");
                }
                redirection(lien("conducteur", "liste"));
            }
        } else {
            ajouterMessage("danger", "Il n'y a pas de Conducteur ayant l'identifiant $id_conducteur");
            redirection(lien("conducteur", "liste"));
        }


        $titre = "Supprimer le conducteur n°$id_conducteur";
        return $this->rendu("/conducteur/form.html.php", ["vechicule" => $conducteur, "titre" => $titre,]);
        $mode = "suppression";
    }
}
