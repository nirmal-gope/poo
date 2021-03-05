<h1>Profil</h1>

<ul class="list-group">
    <li class="list-group-item">
        <strong>Pseudo</strong> : <?= $abonne->getPseudo() ?>
    </li>

    <li class="list-group-item">
        <strong>Niveau</strong> : <?= $abonne->getNiveau() >= 50 ? "Administrateur" : "Lecteur" ?>
    </li>

    <li class="list-group-item">
        <strong>Mes emprunts</strong> : 
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <th>Livre</th>
                <th>Emprunté le</th>
                <th>Rendu le</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($emprunts as $emprunt): ?>
                    <tr>
                        <td> 
                            <!-- Afficher le titre/auteur au lieu de l'id du livre -->
                            <?php 
                                $livre = selectById("livre", $emprunt["livre_id"]);
                                echo $livre["titre"] . " - " .$livre["auteur"];
                            ?>
                        </td>
                        <td>
                            <?= date("d/m/y", strtotime($emprunt["date_emprunt"])) ?>
                        </td>
                        <td>
                            <?= dateFr($emprunt["date_retour"]) ?>
                        </td>
                        <td>
                            <a href="" class="btn btn-info disabled"> Rendre</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </li>
</ul>
