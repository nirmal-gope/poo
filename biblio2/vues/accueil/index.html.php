<h1>Bienvenue à la biblio</h1>
<div class="card-columns">
  <?php foreach($livres as $livre): ?>
    <div class="card ">
      <h4 class="card-header"><?= $livre->getTitre() ?></h4>

      <div class="row  couverture">
          <div class="col-4 d-flex align-items-center">
              <img class="card-img p-1" src="images/<?= $livre->getCouverture() ?>" alt="pas de couverture">
          </div>

          <div class="col-8">
              <div class="card-body">
                  <p class="card-text">De : <?= $livre->getAuteur() ?></p>
              </div>
          </div>
      </div>

      <div class="card-footer">
          <!-- Si le livre est dans la liste des livres non rendus, le lien pour emprunter est déactivé -->
          <a href="emprunter_livre.php?id=<?= $livre->getId() ?>"  
             class="card-link btn text-primary <?= in_array($livre->getId(), $livresNonRendus) ? "disabled" : "" ?>" >
              <i class="fa fa-book"></i> Emprunter
          </a>
            
      </div>
  </div>    
  <?php endforeach ?>

</div>
