<h1>
    <?= empty($titre) ? "Ajouter un nouveau l'association" : $titre ?>
</h1>

<form method="POST">
    <div class="form-group">
        <label for="id_vehicule">Vechicule</label>
        <select name="id_vehicule" id="id_vehicule" class="form-control">
            <option value="">Choisir un vechicule</option>
            <?php foreach ($associations as $association) : ?>
                <option value="<?= $association->getId_conducteur() ?>" <?= !empty($association) && $association($association->getId_conducteur())  == $association->getId_vehicule() ? "selected" : "" ?>>
                    <?= $association->getId_conducteur() ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id_conducteur">conducteur</label>
        <select name="id_conducteur" id="id_conducteur" class="form-control">
            <option value="">Choisir un conducteur</option>
            <?php foreach ($conducteurs as $conducteur) : ?>
                <option value="<?= $conducteur->getId_conducteur ?>" <?= !empty($association) && $association($conducteur->getId_conducteur)  == $conducteur->getId_conducteur ? "selected" : "" ?>>
                    <?= $conducteur->getId_conducteur ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-dark">
        <?= empty($association) ? "Enregistrer" : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier") ?>
    </button>
    <a href="" class="btn btn-danger">Annuler</a>

</form>