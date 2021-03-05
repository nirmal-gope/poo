<?php
include "includes/init.inc.php";
include "vues/header.html.php";
$membre = isConnected();
if (empty($membre)) {
    header("Location: connexion.php");
    exit;
}
?>
<h1>Profil</h1>

<ul class="list-group">
    <li class="list-group-item">
        <strong>Pseudo</strong> : <?= $membre["pseudo"] ?>
    </li>

    <li class="list-group-item">
        <strong>Statut</strong> : <?= $membre["statut"] >= 50 ? "Administrateur" : "Anonne" ?>
    </li>
</ul>

<?php
include "vues/footer.html.php";
