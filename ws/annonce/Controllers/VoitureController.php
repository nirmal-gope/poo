<?php
namespace Controllers;

use Models\VoitureModel as VM;
use Models\Entities\Voiture;

class VoitureController extends BaseController
{
    public function list()
    {
        $voitureModel = new VM;
        $voitures = $voitureModel->selectAll();
        return $this->render("voiture/table.html.php", compact("voitures"));
    }


    public function ajouter()
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
                        $uploadFolder = __DIR__ . "/../uploads";
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
                        $uploadFicheFolder = __DIR__ . "/../uploads";
                        $ficheMove = copy($tempFile, $uploadFicheFolder . "/" . $ficheName);
                        if ($ficheMove) {
                            $_SESSION["messages"]["success"][] = "Le fiche a bien été uploadée";
                            $fiche = $ficheName;
                        } else {
                            $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement du fiche";
                        }
                    }
                    $voitureModel = new VM;
                    $voiture = new Voiture;
                    $voiture->setMarque($marque);
                    $voiture->setKilometrage($kilometrage);
                    $voiture->setTarif($tarif);
                    $voiture->setPhoto($photo);
                    $voiture->setFiche($fiche);
                    $resultat = $voitureModel->insertInto($voiture);

                    if ($resultat) {
                        $_SESSION["message"]["success"][] = "Le nouveau voiture a bien été ajouté";
                        redirection(lien("voiture", "list"));
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

    public function modifier(int $id)
    {
        $voitureModel = new VM;
        $voiture = $voitureModel->selectById($id);

        if ($voiture !== false) {
            if ($_POST) {
                extract($_POST);
                if (!empty($marque) && !empty($kilometrage) && !empty($tarif)) {
                    if (strlen($marque) >= 3 && strlen($marque) <= 30) {

                        if (!empty($photo_actuelle)) {
                            $photo = $photo_actuelle;
                        }
                        if (!empty($_FILES["photo"]["name"])) {
                            $fileName = uniqid() . $_FILES["photo"]["name"];
                            $tempFile = $_FILES["photo"]["tmp_name"];
                            $uploadFolder = __DIR__ . "/../uploads";
                            $fileMove = copy($tempFile, $uploadFolder . "/" . $fileName);
                            if ($fileMove) {
                                $_SESSION["messages"]["success"][] = "L'image a bien été uploadée";
                                $photo = $fileName;
                            } else {
                                $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement de l'image";
                            }
                        }

                        if (!empty($fiche_actuelle)) {
                            $fiche = $fiche_actuelle;
                        }
                        if (!empty($_FILES["fiche"]["name"])) {
                            $ficheName = uniqid() . $_FILES["fiche"]["name"];
                            $tempFile = $_FILES["fiche"]["tmp_name"];
                            $uploadFicheFolder = __DIR__ . "/../uploads";
                            $ficheMove = copy($tempFile, $uploadFicheFolder . "/" . $ficheName);
                            if ($ficheMove) {
                                $_SESSION["messages"]["success"][] = "Le fiche a bien été uploadée";
                                $fiche = $ficheName;
                            } else {
                                $_SESSION["messages"]["danger"][] = "Erreur lors de l'enregistrement du fiche";
                            }
                        }


                        $voiture->setMarque($marque);
                        $voiture->setKilometrage($kilometrage);
                        $voiture->setTarif($tarif);
                        $voiture->setPhoto($photo);
                        $voiture->setFiche($fiche);
                        $resultat = $voitureModel->update($voiture);


                        if ($resultat) {
                            ajouterMessage("success", "Le $marque a bien été modifié");
                            redirection(lien("voiture", "list"));
                            exit;
                        } else {
                            ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");

                        }
                    } else {
                        ajouterMessage("danger", "La marque doit comporter entre 3 et 30 caractères");
                    }
                } else {
                    ajouterMessage("danger", "La marque ne peut pas être vide");
                }
            }
        }
        $titre = "Modifier le voiture : " . $voiture->getMarque();
        return $this->render("voiture/form.html.php", ["voiture" => $voiture, "titre" => $titre]);
    }

    public function supprimer(int $id)
    {
        $voitureModel = new VM;
        $voiture = $voitureModel->selectById($id);

        if ($voiture) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $resultat = $voitureModel->delete($voiture);

                if ($resultat) {
                    ajouterMessage("success", "Le voiture a bien été supprimé");
                } else {
                    ajouterMessage("danger", "Erreur lors de la suppression");
                }
                redirection(lien("voiture", "list"));
            }
        } else {
            ajouterMessage("danger", "Il n'y a pas de voiture ayant l'identifiant $id");
            redirection(lien("voiture", "list"));
        }

        $titre = "Supprimer le voiture : " . $voiture->getMarque();
        $mode= "suppression";
        return $this->render("voiture/form.html.php", ["voiture" => $voiture, "titre" => $titre, "mode" => $mode]);

    }
}
