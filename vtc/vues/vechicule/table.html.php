<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>id_vehicule</th>
        <th>marque</th>
        <th>modele</th>
        <th>couleur</th>
        <th>immatriculation</th>
        <th>Modification</th>
        <th>Suppression</th>

    </thead>

    <tbody>
        <?php foreach ($vechicules as $vechicule) :  ?>
            <tr>
                <td><?= $vechicule->getId_vehicule() ?></td>
                <td><?= $vechicule->getMarque() ?></td>
                <td><?= $vechicule->getModele() ?></td>
                <td><?= $vechicule->getCouleur() ?></td>
                <td><?= $vechicule->getImmatriculation() ?></td>
                <td>
                    <a href="<?= lien("vechicule", "modifier", $vechicule->getId_vehicule()) ?>"><i class="fa fa-edit"></i></a>

                </td>
                <td>

                    <a href="<?= lien("vechicule", "supprimer", $vechicule->getId_vehicule()) ?>"><i class="fa fa-trash"></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>