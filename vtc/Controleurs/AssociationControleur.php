<?php

namespace Controleurs;

use Modeles\AssociationModele as AM;
use Modeles\ConducteurModele;
use Modeles\AssociationModele;
use Modeles\VechiculeModele;
use Modeles\Entites\Association;


class AssociationControleur extends BaseControleur
{
    public function liste()
    {
        $AssociationtModele = new AM;
        $associations = $AssociationtModele->selectAll();
        return $this->rendu("association/table.html.php", compact("associations"));
    }

    public function ajouter()
    {


        $conducteurs = (new ConducteurModele)->selectAll("conducteur");
        $vechicules = (new VechiculeModele)->selectAll("vechicule");

        if ($_POST) {
            extract($_POST);

            if (empty($id_conducteur)) {
                ajouterMessage("danger", "Choisissez un conducteur");
            }
            if (empty($id_vehicule)) {
                ajouterMessage("danger", "Choisissez un vechicule");
            }

            if (!messages("danger")) {
                if (!selectById("conducteur", $id_conducteur)) {
                    ajouterMessage("danger", "Il n'y a pas conducteur avec cet identifiant");
                }
                if (!selectById("vechicule", $id_vehicule)) {
                    ajouterMessage("danger", "Il n'y a pas de vechicule avec cet identifiant");
                }

                if (!messages("danger")) {
                    $pdostatement = $pdo->prepare("INSERT INTO association_vehicule_conducteur (id_vehicule, id_conducteur) VALUES (:id_vehicule, :id_conducteur)");
                    $pdostatement->bindValue(":id_vehicule", $id_vehicule);
                    $pdostatement->bindValue(":id_conducteur", $id_conducteur);
                    if ($pdostatement->execute()) {
                        ajouterMessage("success", "Nouvel association enregistré");
                        redirection(lien("association", "liste"));
                    }
                }
            }
        }

        return $this->rendu("/association/form.html.php");
    }

    public function modifier(int $id_association)
    {


        extract($_GET);
        if (!empty($id_association)) {
            $association = (new AssociationModele)->selectById("association", $id_association);
            if ($association) {
                if ($_POST) {
                    extract($_POST);

                    if (empty($id_conducteur)) {
                        ajouterMessage("danger", "Choisissez un conducteur");
                    }
                    if (empty($id_vehicule)) {
                        ajouterMessage("danger", "Choisissez un vechicule");
                    }


                    if (!messages("danger")) {
                        if (!selectById("conducteur", $id_conducteur)) {
                            ajouterMessage("danger", "Il n'y a pas conducteur avec cet identifiant");
                        }
                        if (!selectById("vechicule", $id_vehicule)) {
                            ajouterMessage("danger", "Il n'y a pas de vechicule avec cet identifiant");
                        }

                        if (!messages("danger")) {
                            $pdostatement = $pdo->prepare("UPDATE association_vehicule_conducteur 
                                                           SET id_conducteur = :id_conducteur, id_vehicule = :id_vehicule
                                                           WHERE id_association = :id_association");
                            $pdostatement->bindValue(":id_conducteur", $id_conducteur);
                            $pdostatement->bindValue(":id_vehicule", $id_vehicule);
                            if ($pdostatement->execute()) {
                                ajouterMessage("success", "association modifié");
                                redirection(lien("association", "liste"));
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

        $titre = "Modfifier l'association n°$id";
        $conducteurs = (new ConducteurModele)->selectAll("conducteur");
        $vechicules = (new VechiculeModele)->selectAll("vechicule");
        return $this->rendu("/association/form.html.php", ["association" => $association, "titre" => $titre,]);
    }

    public function supprimer(int $id_association)
    {


        extract($_GET);
        if (!empty($id_association)) {
            $association = (new AssociationModele)->selectById("association", $id_association);
            if ($association) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $resultat = $pdo->exec("DELETE FROM association_vehicule_conducteur  WHERE id_association = :id_association");
                    if ($resultat) {
                        ajouterMessage("success", "L'association a bien été supprimé");
                    } else {
                        ajouterMessage("danger", "Erreur lors de la suppression");
                    }
                    redirection(lien("association", "liste"));
                }
            } else {
                ajouterMessage("danger", "Il n'y a pas de association ayant l'identifiant $id_association");
                redirection(lien("association", "liste"));
            }
        } else {
            echo "erreur 404 !";
            exit;
        }

        $titre = "Supprimer l'association n°$id_association";
        return $this->rendu("/association/form.html.php", ["association" => $association, "titre" => $titre,]);
        $mode = "suppression";
    }
}
