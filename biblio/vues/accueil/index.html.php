<?php
class accueil
{
    public function liste()
    {
        $livres = selectAll("livre");

        include "vues/header.html.php";
        include "vues/footer.html.php";
    }
}
?>
<h1>Bienvenue à la biblio</h1>
<div class="card-columns">
    <?php foreach ($livres as $livre) : ?>
        <div class="card ">
            <h4 class="card-header"><?= $livre["titre"] ?></h4>

            <div class="row  couverture">
                <div class="col-4 d-flex align-items-center">
                    <img class="card-img p-1" src="images/<?= $livre["couverture"] ?>" alt="pas de couverture">
                </div>

                <div class="col-8">
                    <div class="card-body">
                        <p class="card-text">De : <?= $livre["auteur"] ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <!-- Si le livre est dans la liste des livres non rendus, le lien pour emprunter est déactivé -->
                <a href="emprunter_livre.php?id=<?= $livre["id"] ?>" class="card-link btn text-primary <?= in_array($livre["id"], $livresNonRendus) ? "disabled" : "" ?>">
                    <i class="fa fa-book"></i> Emprunter
                </a>

            </div>
        </div>
    <?php endforeach ?>
</div>