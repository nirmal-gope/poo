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
                    <?= $emprunt->getId() ?>
                </td>
                <td>
                    <?= $emprunt->pseudo ?>
                </td>
                <td> 
                    <?= $emprunt->livre ?>
                </td>
                <td>
                    <?= date("d/m/y", strtotime($emprunt->getDate_emprunt())) ?>
                </td>
                <td>
                    <?= dateFr($emprunt->getDate_retour()) ?>
                </td>
                <td>
                    <a href="<?= lien("emprunt", "modifier", $emprunt->getId()) ?>"> <i class="fa fa-edit"></i></a>
                    <a href="<?= lien("emprunt", "supprimer", $emprunt->getId()) ?>"> <i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
