<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Pseudo</th>
        <th>Niveau</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach($abonnes as $abonne):  ?>
            <tr>
                <td><?= $abonne->getId() ?></td>
                <td><?= $abonne->getPseudo() ?></td>
                <td>
                    <?php 
                        switch($abonne->getNiveau()){
                            case 10:
                                echo "Lecteur";
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
                    <a href="abonne_modifier.php?id=<?= $abonne->getId() ?>"><i class="fa fa-edit"></i></a>
                    <a href="abonne_supprimer.php?id=<?= $abonne->getId() ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
