<h1 class="alert alert-primary">
<?= empty($titre) ? "Ajouter à la liste des véhicule" : $titre ?>

</h1>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="marque">Marque</label>
        <input type="text" class="form-control" name="marque" value="<?= empty($voiture) ? "" : $voiture->getMarque()?>" <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>
    </div>
    <div class="form-group">
        <label for="kilometrage">Kilometrage</label>
        <input type="text" class="form-control" name="kilometrage" value="<?= empty($voiture) ? "" : $voiture->getKilometrage()?>" <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>
    </div>
    <div class="form-group">
        <label for="tarif">Tarif</label>
        <input type="text" class="form-control" name="tarif" value="<?= empty($voiture) ? "" : $voiture->getTarif()?>" <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="custom-file my-4 ">
    <?php if (!empty($voiture) && !empty($voiture->getPhoto())): ?>
            <div class="p-5">
                <img class="miniature" src = "<?= "uploads/" . $voiture->getPhoto() ?>" alt="<?= $voiture->getMarque() ?>">
                <input type="hidden" name="photo_actuelle" value="<?= $voiture->getPhoto() ?>">

            </div>
            <label class="custom-file-label" for="photo"><?= $voiture->getPhoto() ?></label>
        <?php endif; ?>
        <label class="custom-file-label" for="photo">Choisissez une image</label>
        <input type="file" class="custom-file-input" id="photo" name="photo" <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>


    </div>
    <div class="custom-file my-4">
        <input type="file" class="custom-file-input"  name="fiche" <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>

        <?php if (!empty($voiture) && !empty($voiture->getFiche())): ?>

            <embed class="p-3" src = "<?= "uploads/" . $voiture->getFiche() ?>" width=400 height=400 type="application/pdf" />
            <input type="hidden" name="fiche_actuelle" value="<?= $voiture->getFiche() ?>">
            <label class="custom-file-label" for="fiche"><?= $voiture->getFiche() ?></label>

        <?php endif; ?>
        <label class="custom-file-label" for="fiche">Choisissez un fichier</label>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">
        <?= empty($voiture) ? 'Enregistrer' : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier"); ?>
    </button>
    <a href="<?= lien("voiture", "list") ?>" class="btn btn-danger">Annuler</a>
</form>