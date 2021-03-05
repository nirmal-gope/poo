<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>id_conducteur</th>
        <th>prenom</th>
        <th>nom</th>
        <th>Modification</th>
        <th>Suppression</th>

    </thead>

    <tbody>
        <?php foreach ($conducteurs as $conducteur) :  ?>
            <tr>
                <td><?= $conducteur->getId_conducteur() ?></td>
                <td><?= $conducteur->getPrenom() ?></td>
                <td><?= $conducteur->getNom() ?></td>
                <td>
                    <a href="<?= lien("conducteur", "modifier", $conducteur->getId_conducteur()) ?>"><i class="fa fa-edit"></i></a>

                </td>
                <td>

                    <a href="<?= lien("conducteur", "supprimer", $conducteur->getId_conducteur()) ?>"><i class="fa fa-trash"></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>