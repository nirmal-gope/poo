<div class="col-md-6 m-auto">
    <h1 class="alert bg-info">
        <?php if (empty($titre)) : ?>
            Inscription
        <?php else : ?>
            <?= $titre ?>
        <?php endif; ?>
    </h1>
    <form method="POST">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" class="form-control">
        </div>
        <div class="form-group">
            <label for="mdp">MDP</label>
            <input type="text" name="mdp" class="form-control" placeholder="mot de passe">
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" placeholder="nom">
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control" placeholder="prenom">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder=" confirm email">
        </div>
        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="telephone" name="telephone" class="form-control" placeholder="telephone">
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option>choisir</option>
                <option value=10 <?= !empty($membre) && $membre->getStatut() == 10 ? 'selected' : ''; ?>>Abonne</option>
                <option value=30 <?= !empty($membre) && $membre->getStatut() == 30 ? 'selected' : ''; ?>>Vendeur</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="btSupprimer">
            <?= empty($membre) ? "Enregistrer" : (!empty($mode) && $mode == "suppression" ? "Supprimer" : "Modifier") ?>
        </button>
        <a href="<?=lien("membre", "list")?>" class="btn btn-danger">Annuler</a>
    </form>
</div>