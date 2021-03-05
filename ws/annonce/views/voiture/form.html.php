<h1 class="alert alert-primary">
    <?php if (empty($titre)) : ?>
        Ajouter à la liste des véhicule
    <?php else : ?>
        <?= $titre; ?>
    <?php endif; ?>
</h1>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="marque">Marque</label>
        <input type="text" class="form-control" name="marque" value="<?= !empty($voiture["marque"]) ? $voiture["marque"] : "" ?>" id="marque">
    </div>
    <div class="form-group">
        <label for="kilometrage">Kilometrage</label>
        <input type="text" class="form-control" name="kilometrage" value="<?= !empty($voiture["kilometrage"]) ? $voiture["kilometrage"] : "" ?>" id="kilometrage">
    </div>
    <div class="form-group">
        <label for="tarif">Tarif</label>
        <input type="text" class="form-control" name="tarif" value="<?= !empty($voiture["tarif"]) ? $voiture["tarif"] : "" ?>" id=" tarif">
    </div>

    <div class="custom-file my-4 ">


        <?php if (!empty($voiture["photo"])) : ?>
            <div class="p-5">
                <img class="miniature" src="uploads/<?= $voiture["photo"] ?>" alt="<?= $voiture["marque"] ?>">
                <input type="hidden" name="photo_actuelle" value="<?= $voiture["photo"] ?>">

            </div>
            <label class="custom-file-label" for="photo"><?= $voiture["photo"] ?></label>
        <?php endif; ?>
        <label class="custom-file-label" for="photo">Choisissez une image</label>
        <input type="file" class="custom-file-input" id="photo" name="photo">


    </div>
    <div class="custom-file my-4">
        <input type="file" class="custom-file-input" id="fiche" name="fiche">

        <?php if (!empty($voiture["fiche"])) : ?>
            <embed class="p-3" src="uploads/<?= $voiture["fiche"] ?>" width=400 height=400 type='application/pdf' />
            <input type="hidden" name="fiche_actuelle" value="<?= $voiture["fiche"] ?>">
            <label class="custom-file-label" for="fiche"><?= $voiture["fiche"] ?></label>

        <?php endif; ?>
        <label class="custom-file-label" for="fiche">Choisissez un fichier</label>


    </div>

    <button type="submit" class="btn btn-primary" name="submit">
        <?= empty($voiture) ? 'Enregistrer' : (!empty($mode) && $mode == 'suppression' ? 'Supprimer' : 'Modifier'); ?>
    </button>
    <a href="gestion_voitures.php" class="btn btn-danger">Annuler</a>
</form>