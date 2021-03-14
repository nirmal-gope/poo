<?php 
    include "includes/init.inc.php";
    include "vues/header.html.php";
    $abonne = isConnected();
    if( empty($abonne) ){
        header("Location: connexion.php");
        exit;
    }
?>
<h1>Profil</h1>

<ul class="list-group">
    <li class="list-group-item">
        <strong>Pseudo</strong> : <?= $abonne["pseudo"] ?>
    </li>

    <li class="list-group-item">
        <strong>Niveau</strong> : <?= $abonne["niveau"] >= 50 ? "Administrateur" : "Lecteur" ?>
    </li>
</ul>

<?php 
    include "vues/footer.html.php";