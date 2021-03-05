<h1>
    <?= empty($titre) ? "Ajouter un nouveau  Conducteur" : $titre ?>
</h1>

<form method="POST">
    <div class="form-group">
        <label for="prenom">prenom</label>
        <input type="text" name="prenom" class="form-control">
    </div>
    <div class="form-group">
        <label for="nom">nom</label>
        <input type="text" name="nom" class="form-control">
    </div>


    <button type="submit" class="btn btn-primary" name="btSupprimer">
        <?= empty($conducteur) ? "Enregistrer" : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier") ?>
    </button>
    <a href="livre_liste.php" class="btn btn-danger">Annuler</a>

</form>