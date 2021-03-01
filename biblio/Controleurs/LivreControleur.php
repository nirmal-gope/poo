<?php
class LivreControleur
{
    public function liste()
    {
        if (!isAdmin()) {
            ajouterMessage("danger", "Accès interdit !");
            redirection("index.php");
        }

        $livres = selectAll("livre");

        include "vues/header.html.php";
        include "vues/livre/table.html.php";
        include "vues/footer.html.php";
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
                    ajouterMessage("danger", "Le titre ne doit pas dépasser 50 caractères");
                }
                if (strlen($auteur) < 2 || strlen($auteur) > 50) {
                    ajouterMessage("danger", "L'auteur doit comporter entre 2 et 50 caratères");
                }
                // Si il n'y a pas de messages d'erreur, mon formulaire est valide
                if (empty($_SESSION["messages"]["danger"])) {
                    if (!empty($_FILES["couverture"]["name"])) {
                        // La fonction uniqid() permet de générer un string unique 
                        $nomFichier = uniqid() . $_FILES["couverture"]["name"];
                        // __DIR__ est une constante magique : la valeur est le chemin complet du dossier
                        //          dans lequel se trouve le fichier actuel
                        $dossier = __DIR__ . "/../images";
                        // La fonction copy($source, $destination) copie un fichier $source vers un autre fichier $destination
                        $imageSaved = copy($_FILES["couverture"]["tmp_name"], $dossier . "/" . $nomFichier);
                        if ($imageSaved) {
                            ajouterMessage("success", "L'image a bien été uploadée");
                            $couverture = $nomFichier;
                        } else {
                            ajouterMessage("danger", "Erreur lors de l'enregistrement de l'image");
                        }
                    }
                    //INSERTION en DBB
                    $resultat = insertInto("livre", compact("titre", "auteur", "couverture")); //compact is opposite of extract
                    if ($resultat) {
                        ajouterMessage("success", "Le nouveau livre a bien été ajouté ");
                        redirection(lien("livre", "liste"));
                    } else {
                        ajouterMessage("danger", "Erreur lors de l'insertion en bdd");
                    }
                }
            } else {
                ajouterMessage("danger", "Veuillez renseigner les champs obligatoires");
            }
        }

        include "vues/header.html.php";
        include "vues/livre/form.html.php";
        include "vues/footer.html.php";
    }
    public function modifier(int $id)
    {
        if (!isAdmin()) {
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }


        $livre = selectById("livre", $id);
        if ($livre !== false) {
            if ($_POST) {
                extract($_POST);
                // CONTROLE DES CHAMPS DU FORMULAIRE
                if (empty($titre)) {
                    ajouterMessage("danger", "Le titre est obligatoire");
                } else {
                    $titre = trim($titre);
                    if (strlen($titre) > 50) {
                        ajouterMessage("danger", "Le titre ne doit pas dépasser 50 caractères");
                    }
                }
                if (empty($auteur)) {
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
                    if (!empty($name)) {
                        $positionPoint = strrpos($name, ".", -1);
                        $extension = substr($name, $positionPoint);
                        $nomFichier = substr($name, 0, strlen($name) - $positionPoint);
                        $nomFichier = $nomFichier . "_" . time() . $extension;
                        $dossier = __DIR__ . "/../images";
                        $imageSaved = copy($tmp_name, $dossier . "/" . $nomFichier);
                        if ($imageSaved) {
                            ajouterMessage("success", "L'image a bien été téléversée");
                            $couverture = $nomFichier;
                        } else {
                            ajouterMessage("danger", "Erreur lors de l'enregistrement de l'image");
                        }
                    }

                    global $pdo;
                    $pdostatement = $pdo->prepare("UPDATE livre 
                                                SET titre = :titre, auteur = :auteur, couverture = :couverture
                                                WHERE id = :id");
                    $pdostatement->bindValue(":titre", $titre);
                    $pdostatement->bindValue(":auteur", $auteur);
                    $pdostatement->bindValue(":couverture", $couverture);
                    $pdostatement->bindValue(":id", $id);
                    $resultat = $pdostatement->execute();
                    if ($resultat) {
                        ajouterMessage("success", "Le livre a bien été modifié ");
                        redirection(lien("livre", "liste"));
                    } else {
                        ajouterMessage("danger", "Erreur lors de l'actualisation en bdd");
                    }
                }
            }
        }

        $titre = "Modfifier le livre n°$id";
        include "vues/header.html.php";
        include "vues/livre/form.html.php";
        include "vues/footer.html.php";
    }

    public function supprimer(int $id)
    {

        if (!isAdmin()) {
            ajouterMessage("danger", "Accès interdit !");
            redirection("./");
        }

        $livre = selectById("livre", $id);
        if ($livre) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                global $pdo;
                $resultat = $pdo->exec("DELETE FROM livre WHERE id = $id");
                if ($resultat) {
                    ajouterMessage("success", "Le lilvre a bien été supprimé");
                } else {
                    ajouterMessage("danger", "Erreur lors de la suppression");
                }
                redirection(lien("livre", "liste"));
            }
        } else {
            ajouterMessage("danger", "Il n'y a pas de livre ayant l'identifiant $id");
            redirection(lien("livre", "liste"));
        }


        include "vues/header.html.php";
        $titre = "Supprimer le livre n°$id";
        $mode = "suppression";
        include "vues/livre/form.html.php";
        include "vues/footer.html.php";
    }
}
