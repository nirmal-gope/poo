<?php
include "includes/init.inc.php";
if( !isAdmin() ){
    $_SESSION["messages"]["danger"][] = "Accès interdit !";
    redirection("index.php");
}

include "vues/header.html.php";

$pdostatement = $pdo->query("SELECT * FROM livre");
if( $pdostatement && $pdostatement->rowCount() > 0 ){
    $livres = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
}

?> 

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
                <td><?= $livre["id"] ?></td>
                <td>
                    <img class="miniature" src="images/<?= $livre["couverture"] ?>" alt="<?= $livre["titre"] ?>">
                </td>
                <td><?= $livre["titre"] ?></td>
                <td><?= $livre["auteur"] ?></td>
                <td>
                    <a href="livre_modifier.php?id=<?= $livre["id"] ?>"><i class="fa fa-edit"></i></a>
                    <a href="livre_supprimer.php?id=<?= $livre["id"] ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "vues/footer.html.php"; ?>