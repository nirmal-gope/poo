<?php

namespace Controleurs;

use Modeles\VechiculeModele as VM;
use Modeles\Entites\Vechicule;


class VechiculeControleur extends BaseControleur
{
    public function liste()
    {
        $VechiculeModele = new VM;
        $vechicules = $VechiculeModele->selectAll();

        return $this->rendu("/vechicule/table.html.php", compact("vechicules"));
    }

    public function ajouter()
    {

        if ($_POST) {
            extract($_POST);
            if (!empty($marque) && !empty($modele) && !empty($couleur) && !empty($immatriculation)) {

                if (strlen($marque) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le marque ne doit pas dépasser 50 caractères";
                }
                if (strlen($modele) < 2 || strlen($modele) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le modele doit comporter entre 2 et 50 caratères";
                }
                if (strlen($couleur) < 2 || strlen($couleur) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le couleur doit comporter entre 2 et 50 caratères";
                }
                if (strlen($mimmatriculation) < 2 || strlen($immatriculation) > 50) {
                    $_SESSION["messages"]["danger"][] = "Le immatriculation doit comporter entre 2 et 50 caratères";
                }

                $VechiculeModele = new VM;
                $vechicule = new Vechicule;
                $vechicule->setMarque($marque);
                $vechicule->setModele($modele);
                $vechicule->setCouleur($couleur);
                $vechicule->setImmatriculation($immatriculation);
                $resultat = $VechiculeModele->insertInto($vechicule);

                if ($resultat) {
                    $_SESSION["messages"]["success"][] = "Le nouveau vechicule a bien été ajouté ";
                    redirection(lien("vechicule", "liste"));
                } else {
                    $_SESSION["messages"]["danger"][] = "Erreur lors de l'insertion en bdd";
                }
            } else {
                $_SESSION["messages"]["danger"][] = "Veuillez renseigner les champs obligatoires";
            }
        }

        return $this->rendu("/vechicule/form.html.php");
    }
    public function modifier(int $id_vehicule)
    {
        $VechiculeModele = new VM;
        $vechicule = $VechiculeModele->selectById($id_vehicule);

        if ($vechicule !== false) {
            if ($_POST) {
                extract($_POST);
                if (empty($marque)) {
                    ajouterMessage("danger", "Le marque est obligatoire");
                } else {
                    $marque = trim($marque);
                    if (strlen($marque) > 50) {
                        ajouterMessage("danger", "Le marque ne doit pas dépasser 50 caractères");
                    }
                }
                if (empty($modele)) {
                    ajouterMessage("danger", "Le modele est obligatoire");
                } else {
                    $modele = trim($modele);
                    if (strlen($modele) < 2 || strlen($modele) > 50) {
                        ajouterMessage("danger", "Le modele doit comporter entre 2 et 50 caratères");
                    }
                }
                if (empty($couleur)) {
                    ajouterMessage("danger", "Le couleur est obligatoire");
                } else {
                    $couleur = trim($couleur);
                    if (strlen($couleur) < 2 || strlen($couleur) > 50) {
                        ajouterMessage("danger", "Le couleur doit comporter entre 2 et 50 caratères");
                    }
                }
                if (empty($immatriculation)) {
                    ajouterMessage("danger", "Le immatriculation est obligatoire");
                } else {
                    $immatriculation = trim($immatriculation);
                    if (strlen($immatriculation) < 2 || strlen($immatriculation) > 50) {
                        ajouterMessage("danger", "Le immatriculation doit comporter entre 2 et 50 caratères");
                    }
                }

                $vechicule->setMarque($marque);
                $vechicule->setModele($modele);
                $vechicule->setCouleur($couleur);
                $vechicule->setImmatriculation($immatriculation);
                $resultat = $VechiculeModele->update($vechicule);

                if ($resultat) {
                    ajouterMessage("success", "Le Vechicule a bien été modifié ");
                    redirection(lien("vechicule", "liste"));
                } else {
                    ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");
                }
            }
        }
        $titre = "Modifier le vechicule n°$id_vehicule";
        return $this->rendu("/vechicule/form.html.php", ["vechicule" => $vechicule, "titre" => $titre,]);
    }

    public function supprimer(int $id_vehicule)
    {
        $VechiculeModele = new VM;
        $vechicule = $VechiculeModele->selectById($id_vehicule);

        if ($vechicule) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $resultat = $VechiculeModele->delete($vechicule);

                if ($resultat) {
                    ajouterMessage("success", "Le vechicule a bien été supprimé");
                } else {
                    ajouterMessage("danger", "Erreur lors de la suppression");
                }
                redirection(lien("vechicule", "liste"));
            }
        } else {
            ajouterMessage("danger", "Il n'y a pas de vechicule ayant l'identifiant $id_vehicule");
            redirection(lien("vechicule", "liste"));
        }

        $titre = "Supprimer le vechicule n°$id_vehicule";
        return $this->rendu("/vechicule/form.html.php", ["vechicule" => $vechicule, "titre" => $titre,]);
        $mode = "suppression";
    }
}
