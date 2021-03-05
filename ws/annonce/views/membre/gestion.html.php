<?php

if (!isAdmin()) {
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}

?>

<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Pseudo</th>
        <th>Statut</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach ($membres as $membre) :  ?>
            <tr>
                <td><?= $membre["id"] ?></td>
                <td><?= $membre["pseudo"] ?></td>
                <td>
                    <?php

                    switch ($membre["statut"]) {
                        case 10:
                            echo "Abonne";
                            break;
                        case 30:
                            echo "Bibliothécaire";
                            break;
                        case 50:
                            echo "Administrateur";
                            break;
                        default:
                            echo "Niveau inconnu";
                    }
                    ?>
                </td>
                <td>
                    <a href="abonne_modifier.php?id=<?= $membre["id"] ?>">Modifier</a>
                    <a href="abonne_supprimer.php?id=<?= $membre["id"] ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "vues/footer.html.php"; ?>