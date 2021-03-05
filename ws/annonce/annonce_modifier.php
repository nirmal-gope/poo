<?php
include "includes/init.inc.php";
if (!isAbonne()) {
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}


if (!empty($_GET["id"])) {
    extract($_GET);
    $pdostatement = $pdo->prepare("SELECT * FROM voitures WHERE id = :id");
    $pdostatement->bindValue(":id", $id);
    $resultat = $pdostatement->execute();
    if ($resultat && $pdostatement->rowCount() == 1) {
        $voiture = $pdostatement->fetch(PDO::FETCH_ASSOC);
        if ($_POST) {
            extract($_POST);

            if (!empty($marque && $kilometrage && $tarif)) {
                if (strlen($marque) >= 3 && strlen($marque) <= 30) {

                    //if the phot is not modified this function will keep the last uploaded photo
                    if (!empty($photo_actuelle)) {
                        $photo = $photo_actuelle;
                    }
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

                    //if the fiche is not modified this function will keep the last uploaded fiche

                    if (!empty($fiche_actuelle)) {
                        $fiche = $fiche_actuelle;
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

                    $sqlRequete = "UPDATE voitures SET marque = :marque";
                    if (($kilometrage && $tarif) >= 1) {
                        $sqlRequete .= ", kilometrage = :kilometrage, tarif = :tarif";
                    }
                    $sqlRequete .= ", photo = :photo";
                    $sqlRequete .= ", fiche = :fiche";
                    $sqlRequete .= " WHERE id = :id;";

                    // dd($texteRequete);
                    $pdostatement = $pdo->prepare($sqlRequete);

                    $pdostatement->bindValue(":marque", $marque);
                    $pdostatement->bindValue(":kilometrage", $kilometrage);
                    $pdostatement->bindValue(":tarif", $tarif);
                    $pdostatement->bindValue(":photo", $photo);
                    $pdostatement->bindValue(":fiche", $fiche);
                    $pdostatement->bindValue(":id", $id);
                    $resultat = $pdostatement->execute();
                    if ($resultat) {
                        $msgSucces = "L'annonce $marque a bien été modifié";
                        $_SESSION["messages"]["success"][] = $msgSucces;
                        header("Location: gestion_voitures.php");
                        exit;
                    } else {
                        $msgErreur = "Erreur BDD";
                        $_SESSION["messages"]["danger"][] = $msgErreur;
                    }
                } else {
                    $msgErreur = "La marque doit comporter entre 3 et 30 caractères";
                    $_SESSION["messages"]["danger"][] = $msgErreur;
                }
            } else {
                $msgErreur = "La marque ne peut pas être vide";
                $_SESSION["messages"]["danger"][] = $msgErreur;
            }
        }
    }
} else {
    echo "erreur 404 !";
    exit;
}

include "vues/header.html.php";
$titre = "Modifier l'annonce n°$id";
include "vues/form_voiture.html.php";
include "vues/footer.html.php";
