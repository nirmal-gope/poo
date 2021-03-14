<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="./">BIBLIO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href=".">Accueil <span class="sr-only">(current)</span></a>
                    </li>

                    <?php if (isAdmin()) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Abonnés
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= lien("abonne", "liste") ?>" ><i class="fa fa-users"></i> Liste</a>
                                <a class="dropdown-item" href="<?= lien("abonne", "ajouter") ?>" ><i class="fa fa-user-plus"></i> Ajouter</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Livres
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= lien("livre", "liste") ?>"><i class="fa fa-book"></i> Liste</a>
                                <a class="dropdown-item" href="<?= lien("livre", "ajouter") ?>"><i class="fa fa-plus-square"></i> Ajouter</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Emprunts
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= lien("emprunt", "liste") ?>"><i class="fa fa-file-export"></i> Liste</a>
                                <a class="dropdown-item" href="<?= lien("emprunt", "ajouter") ?>"><i class="fa fa-plus-square"></i> Ajouter</a>
                            </div>
                        </li>
                    <?php endif; ?>

                    <!--Je peux faire une affectation dans la condition du if
                        PHP va d'abord évaluer l'affectation (donc $abonne sera soit un array soit false) 
                        ensuite PHP va évaluer la condition : if($abonne)
                        Je peux donc utiliser la variable $abonne dans le code du 'if'  -->
                    <?php if ($abonneConnecte = isConnected()) : ?>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= lien("user", "profil") ?>">
                                <?= $abonneConnecte->getPseudo() ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= lien("user", "deconnexion") ?>">
                                <i class="fa fa-sign-out"></i>
                            </a>
                        </li>

                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= lien("user", "connexion") ?>"> <i class="fa fa-sign-in"></i> </a>
                        </li>

                    <?php endif; ?>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> <i class="fa fa-search"></i> </button>
                </form>
            </div>
        </nav>

        <?php
            if (isset($_SESSION["messages"])) {
                foreach ($_SESSION["messages"] as $type => $messages) {
                    foreach ($messages as $msg) {
                        echo "<div class='alert alert-$type'>$msg</div>";
                    }
                }
            }
            /* Pour supprimer une valeur précise d'un tableau, on peut utiliser la fonction unset($variable) 
                La fonction unset détruit une variable. Si on met une variable array avec un indice, seul cet indice est
                supprimé. Par exemple unset($tableau[2]) ne détruit que la 3ième valeur de $tableau. */
            unset($_SESSION["messages"]);
        ?>

        <?= $contenu ?>

    </div><!-- fin div class container -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>
