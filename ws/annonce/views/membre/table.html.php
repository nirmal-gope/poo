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
                <td><?= $membre->getId()?></td>
                <td><?= $membre->getPseudo() ?></td>
                <td>
                    <?php

                    switch ($membre->getStatut()) {
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
                    <a href="<?=lien("membre", "modifier", $membre->getId()) ?>">Modifier</a>
                    <a href="<?=lien("membre", "supprimer", $membre->getId()) ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
