<table class="table table-bordered table-responsive-md text-center table-hover my-4">
    <thead class="table-primary">
        <th>ID</th>
        <th>Marque</th>
        <th>Kilometrage</th>
        <th>Tarif</th>
        <th>Photo</th>
        <th>Fiche</th>
        <?php if ($abonneConnecte = isConnected()) : ?>
            <th>Actions</th>
        <?php endif; ?>

    </thead>

    <tbody>
        <?php foreach ($Voitures as $voiture) :  ?>
            <tr>
                <td><?= $voiture["id"] ?></td>
                <td><?= $voiture["marque"] ?></td>
                <td><?= $voiture["kilometrage"] ?></td>
                <td><?= $voiture["tarif"] ?></td>
                <td><a href="uploads/<?= $voiture["photo"] ?>"><img class="miniature" src="uploads/<?= $voiture["photo"] ?>" alt="<?= $voiture["marque"] ?>"></a>
                </td>
                <td><a href="uploads/<?= $voiture["fiche"] ?>" class="btn btn-secondary">Télécharger la détailée</a>
                </td>
                <?php if ($abonneConnecte = isConnected()) : ?>

                    <td>
                        <a class="btn btn-primary m-1" href="annonce_modifier.php?id=<?= $voiture["id"] ?>">Modifier</a>
                        <a class="btn btn-danger m-1" href="annonce_supprimer.php?id=<?= $voiture["id"] ?>">Supprimer</a>
                    </td>
                <?php endif; ?>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>