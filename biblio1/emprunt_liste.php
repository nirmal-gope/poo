<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    ajouterMessage("danger", "Erreur 403 - Accès interdit");
    redirection("./");
}

include "vues/header.html.php";
?>

<h1>Liste des emprunts</h1>

<table class="table table-bordered table-striped">
    <thead>
        <th>ID</th>
        <th>Abonné</th>
        <th>Livre</th>
        <th>Emprunté le</th>
        <th>Rendu le</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach(selectAll("emprunt") as $emprunt): ?>
            <tr>
                <td>
                    <?= $emprunt["id"] ?>
                </td>
                <td>
                    <!-- Afficher le pseudo au lieu de l'id de l'abonné -->
                    <?php
                        $abonne = selectById("abonne", $emprunt["abonne_id"]);
                        echo $abonne["pseudo"];
                    ?>
                </td>
                <td> 
                    <!-- Afficher le titre/auteur au lieu de l'id du livre -->
                    <?php 
                        $livre = selectById("livre", $emprunt["livre_id"]);
                        echo $livre["titre"] . " - " .$livre["auteur"];
                    ?>
                </td>
                <td>
                    <?= $emprunt["date_emprunt"] ?>
                </td>
                <td>
                    <?= $emprunt["date_retour"] ?>
                </td>
                <td>
                    <a href="emprunt_modifier.php?id=<?= $emprunt["id"] ?>"> <i class="fa fa-edit"></i></a>
                    <a href="emprunt_supprimer.php?id=<?= $emprunt["id"] ?>"> <i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
