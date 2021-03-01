<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Couverture</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach ($livres as $livre) :  ?>
            <tr>
                <td><?= $livre["id"] ?></td>
                <td>
                    <img class="miniature" src="images/<?= $livre["couverture"] ?>" alt="<?= $livre["titre"] ?>">
                </td>
                <td><?= $livre["titre"] ?></td>
                <td><?= $livre["auteur"] ?></td>
                <td>
                    <a href="<?= lien("livre", "modifier", $livre["id"]) ?>"><i class=" fa fa-edit"></i></a>
                    <a href="<?= lien("livre", "supprimer", $livre["id"]) ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>