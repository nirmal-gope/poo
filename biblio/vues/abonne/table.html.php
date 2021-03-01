<table class="table table-bordered table-striped text-center">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Pseudo</th>
        <th>Niveau</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach($abonnes as $abonne):  ?>
            <tr>
                <td><?= $abonne["id"] ?></td>
                <td><?= $abonne["pseudo"] ?></td>
                <td>
                    <?php 
                        switch($abonne["niveau"]){
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
                    <a href="abonne_modifier.php?id=<?= $abonne["id"] ?>"><i class="fa fa-edit"></i></a>
                    <a class="ml-4" href="abonne_supprimer.php?id=<?= $abonne["id"] ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>