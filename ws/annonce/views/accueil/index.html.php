<?php
include "includes/init.inc.php";
include "vues/header.html.php";
$voitures = selectAll("voitures");
?>

<h2 class="alert alert-primary my-4 text-dark">La liste des voitures disponibles</h2>

<div class="card-columns">
    <?php foreach ($voitures as $voiture) :  ?>
        <div class="card">
            <img class="card-img-top" src="uploads/<?= $voiture["photo"] ?>" alt="<?= $voiture["marque"] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $voiture["marque"] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $voiture["kilometrage"] . " km" ?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?= $voiture["tarif"] . " €" ?></h6>
                <p class="card-text">Annonce publié par : Nirmal</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>



<?php include "vues/footer.html.php"; ?>