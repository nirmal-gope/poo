<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>id_association</th>
        <th>vehicule</th>
        <th>conducteur</th>
        <th>Modification</th>
        <th>Suppression</th>
    </thead>
    <tbody>
        <?php foreach ($associations as $association) : ?>
            <tr>
                <td>
                    <?= $association->getId_association() ?>
                </td>
                <td>
                    <?= $association->getId_vehicule() ?>
                </td>
                <td>
                    <?= $association->getId_conducteur() ?>
                </td>
                <td>
                    <a href="<?= lien("association", "modifier", $association->getId_association()) ?>"><i class="fa fa-edit"></i></a>

                </td>
                <td>

                    <a href="<?= lien("association", "supprimer", $association->getId_association()) ?>"><i class="fa fa-trash"></i></a>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>