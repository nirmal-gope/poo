<h1>
    <?= empty($titre) ? "Ajouter un nouveau  Vechicule" : $titre ?>
</h1>

<form method="POST">
    <div class="form-group">
        <label for="marque">marque</label>
        <input type="text" name="marque" class="form-control">
    </div>
    <div class="form-group">
        <label for="modele">modele</label>
        <input type="text" name="modele" class="form-control">
    </div>
    <div class="form-group">
        <label for="couleur">couleur</label>
        <input type="text" name="couleur" class="form-control">
    </div>
    <div class="form-group">
        <label for="immatriculation">immatriculation</label>
        <input type="text" name="immatriculation" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary" name="btSupprimer">
        <?= empty($vechicule) ? "Enregistrer" : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier") ?>
    </button>
    <a href="lien("vechicule", "liste")" class="btn btn-danger">Annuler</a>

</form>