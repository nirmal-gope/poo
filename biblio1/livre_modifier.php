<?php
include "includes/init.inc.php";
if (!isAdmin()) {
    ajouterMessage("danger", "Accès interdit !");
    redirection("./");
}

if (!empty($_GET["id"])){
    extract($_GET);
    $livre = selectById("livre", $id);
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
                $couverture = $livre["couverture"];
                if( !empty($name) ){
                    $positionPoint = strrpos($name, ".", -1);
                    $extension = substr($name, $positionPoint);
                    $nomFichier = substr($name, 0, strlen($name) - $positionPoint);
                    $nomFichier = $nomFichier . "_" . time() . $extension;
                    $dossier = __DIR__ . "/images";
                    $imageSaved = copy($tmp_name, $dossier . "/" . $nomFichier);
                    if($imageSaved) {
                        ajouterMessage("success", "L'image a bien été téléversée");
                        $couverture = $nomFichier;
                    } else {
                        ajouterMessage("danger", "Erreur lors de l'enregistrement de l'image");
                    }
                }
                $pdostatement = $pdo->prepare("UPDATE livre 
                                               SET titre = :titre, auteur = :auteur, couverture = :couverture
                                               WHERE id = :id");
                $pdostatement->bindValue(":titre", $titre);
                $pdostatement->bindValue(":auteur", $auteur);
                $pdostatement->bindValue(":couverture", $couverture);
                $pdostatement->bindValue(":id", $id);
                $resultat = $pdostatement->execute();
                if($resultat){
                    ajouterMessage("success", "Le livre a bien été modifié ");
                    redirection("livre_liste.php");
                } else {
                    ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");
                }
            }
        }
    }

} else {
    echo "erreur 404 !";
    exit;
}

$titre = "Modfifier le livre n°$id";
include "vues/header.html.php";
include "vues/form_livre.html.php";
include "vues/footer.html.php";
