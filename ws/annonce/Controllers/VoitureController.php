<?php

namespace Controllers;

use Models\VoitureModel as VM;

class VoitureController extends BaseController
{
    public function list()
    {
        $VoitureModel = new VM;
        $voitures = $VoitureModel->selectAll();
        return $this->render("voiture/gestion.html.php", compact("voitures"));
    }
    public function insert()
    {

        if ($_POST) {
            extract($_POST);

            if (!empty($marque) && !empty($kilometrage) && !empty($tarif)) {
                if (strlen($marque) > 15) {
                    $_SESSION["messages"]["danger"][] = "Le marque ne doit pas dépasser 15 caractères";
                }
                if ($kilometrage >= 1 && $kilometrage <= 6) {
                    $_SESSION["messages"]["danger"][] = "Kilometrage doit comporter entre 1 et 6 caractères";
                }
                if ($tarif >= 1 && $tarif <= 6) {
                    $_SESSION["messages"]["danger"][] = "Tariff doit comporter entre 1 et 6 caractères";
                }
                if (empty($_SESSION["messages"]["danger"])) {
                    if (!empty($_FILES["photo"]["name"])) {
                        $fileName = uniqid() . $_FILES["photo"]["name"];
                        $tempFile = $_FILES["photo"]["tmp_name"];
                        $uploadFolder = __DIR__ . "/uploads";
                        $fileMove = copy($tempFile, $uploadFolder . "/" . $fileName);
                        if ($fileMove) {
                            $_SESSION["messages"]["success"][] = "L'image a bien été uploadée";
                            $photo = $fileName;
                        } else {
                            $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement de l'image";
                        }
                    }
                    if (!empty($_FILES["fiche"]["name"])) {
                        $ficheName = uniqid() . $_FILES["fiche"]["name"];
                        $tempFile = $_FILES["fiche"]["tmp_name"];
                        $uploadFicheFolder = __DIR__ . "/uploads";
                        $ficheMove = copy($tempFile, $uploadFicheFolder . "/" . $ficheName);
                        if ($ficheMove) {
                            $_SESSION["messages"]["success"][] = "Le fiche a bien été uploadée";
                            $fiche = $ficheName;
                        } else {
                            $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement du fiche";
                        }
                    }
                    $VoitureModele = new VM;
                    $voiture = new Voiture;
                    $pdostatement->bindValue(":marque", $voiture->setMarque());
                    $pdostatement->bindValue(":kilometrage", $voiture->setKilometrage());
                    $pdostatement->bindValue(":tarif", $voiture->setTarif());
                    $pdostatement->bindValue(":photo", $voiture->setPhoto() ?? null);
                    $pdostatement->bindValue(":fiche", $voiture->setFiche() ?? null);
                    $resultat = $VoitureModele->insertInto($Voiture);

                    $resultat = $pdostatement->execute();
                    if ($resultat) {
                        $_SESSION["message"]["success"][] = "Le nouveau livre a bien été ajouté";
                        redirection("gestion_voitures.php");
                    } else {
                        $_SESSION["message"]["success"][] = "Erreur lors de l'insertion en bdd";
                    }
                }
            } else {
                $_SESSION['messages']['danger'][] = 'Veuillez renseigner les champs obligatoires';
            }
        }

        return $this->render("voiture/form.html.php");
    }
}
