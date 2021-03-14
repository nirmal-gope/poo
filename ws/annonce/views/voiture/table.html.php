<table class="table table-bordered table-responsive-md text-center table-hover my-4">
    <thead class="table-primary">
        <th>ID</th>
        <th>Marque</th>
        <th>Kilometrage</th>
        <th>Tarif</th>
        <th>Photo</th>
        <th>Fiche</th>
        <th>Actions</th>

    </thead>

    <tbody>
        <?php foreach ($voitures as $voiture) :  ?>
            <tr>
                <td><?= $voiture->getId() ?></td>
                <td><?= $voiture->getMarque() ?></td>
                <td><?= $voiture->getKilometrage() ?></td>
                <td><?= $voiture->getTarif() ?></td>
                <td><a href="uploads/<?= $voiture->getPhoto() ?>"><img class="miniature" src="uploads/<?= $voiture->getPhoto() ?>" alt="<?= $voiture->getMarque() ?>"></a>
                </td>
                <td><a href="uploads/<?= $voiture->getFiche() ?>" class="btn btn-secondary">Télécharger la détailée</a>
                </td>

                <td>
                    <a class="btn btn-primary m-1" href="<?= lien("voiture", "modifier", $voiture->getId()) ?>">Modifier</a>
                    <a class="btn btn-danger m-1" href="<?= lien("voiture", "supprimer", $voiture->getId()) ?>">Supprimer</a>
                </td>


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>