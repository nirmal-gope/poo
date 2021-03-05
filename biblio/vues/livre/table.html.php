<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Couverture</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach($livres as $livre):  ?>
            <tr>
                <td><?= $livre->getId() ?></td>
                <td>
                    <img class="miniature" src="images/<?= $livre->getCouverture() ?>" alt="<?= $livre->getTitre() ?>">
                </td>
                <td><?= $livre->getTitre() ?></td>
                <td><?= $livre->getAuteur() ?></td>
                <td>
                    <a href="<?= lien("livre", "modifier", $livre->getId()) ?>"><i class="fa fa-edit"></i></a>
                    <a href="<?= lien("livre", "supprimer", $livre->getId()) ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
