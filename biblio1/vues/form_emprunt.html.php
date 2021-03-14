<h1><?= $title ?? "Nouvel emprunt" ?></h1>

<form method="POST">
    <div class="form-group">
        <label for="">Abonné</label>
        <select name="abonne_id" id="" class="form-control">
            <option value="">Choisir un abonné...</option>
            <?php foreach($abonnes as $abonne): ?>
                <option value="<?= $abonne["id"] ?>" <?= !empty($emprunt) && $emprunt["abonne_id"] == $abonne["id"] ? "selected" : "" ?>>
                    <?= $abonne["pseudo"] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Livre</label>
        <select name="livre_id" id="" class="form-control">
            <option value="">Choisir un livre...</option>
            <?php foreach ($livres as $livre): ?>
                <option value="<?= $livre["id"] ?>"  <?= !empty($emprunt) && $emprunt["livre_id"] == $livre["id"] ? "selected" : "" ?>>
                    <?= $livre["titre"] . " - " . $livre["auteur"] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Date emprunt</label>
        <input type="date" name="date_emprunt" class="form-control" value="<?= empty($emprunt) ? "" : $emprunt['date_emprunt'] ?>">
    </div>
    <div class="form-group">
        <label for="">Date retour</label>
        <input type="date" name="date_retour" class="form-control" value="<?= empty($emprunt) ? "" : $emprunt['date_retour'] ?>">
    </div>

    <button type="submit" class="btn btn-dark">
        <?= empty($abonne) ? "Enregistrer" : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier") ?>
    </button>
    <a href="emprunt_liste.php" class="btn btn-danger">Annuler</a>

</form>