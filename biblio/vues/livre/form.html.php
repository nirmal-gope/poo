<h1>
    <?= empty($titre) ? "Ajouter un nouveau livre" : $titre ?>
</h1>

<!-- 
    Pour pouvoir téléverser des fichiers, votre formulaire doit avoir l'attribut
    enctype. La valeur doit être "multipart/form-data"
-->
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre</label>
        <input type="text" name="titre" class="form-control" 
                value="<?= empty($livre) ? "" : $livre->getTitre() ?>"
                <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>
    </div>
    <div class="form-group">
        <label for="">Auteur</label>
        <input type="text" name="auteur" class="form-control"
                value="<?= empty($livre) ? '' : $livre->getAuteur() ?>"
                <?= !empty($mode) && $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="form-group">
        <label for="couverture">Couverture</label>
        <?php if (!empty($livre) && !empty($livre->getCouverture())): ?>
            <img src="<?= "images/" . $livre->getCouverture() ?>" alt="" class="miniature">
        <?php endif ?>
        <input type="file" name="couverture" id="couverture" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary" name="btSupprimer">
        <?= empty($livre) ? "Enregistrer" : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier") ?>
    </button>
    <a href="<?= lien("livre", "liste") ?>" class="btn btn-danger">Annuler</a>
</form>