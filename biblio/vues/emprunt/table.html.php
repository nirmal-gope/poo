<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Abonné</th>
        <th>Livre</th>
        <th>Emprunté le</th>
        <th>Rendu le</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($emprunts as $emprunt): ?>
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
                    <?= date("d/m/y", strtotime($emprunt["date_emprunt"])) ?>
                </td>
                <td>
                    <?= dateFr($emprunt["date_retour"]) ?>
                </td>
                <td>
                    <a href="emprunt_modifier.php?id=<?= $emprunt["id"] ?>"> <i class="fa fa-edit"></i></a>
                    <a href="emprunt_supprimer.php?id=<?= $emprunt["id"] ?>"> <i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
