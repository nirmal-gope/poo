<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce Voiture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-light navbar-expand-xl " style="background-color: #5bc0de;">
            <a class="navbar-brand" href="./">Consession Voitures</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href=" <?= lien("voiture", "list") ?> ">Gestion des voitures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= lien("membre", "list") ?> ">Gestion des membres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= lien("voiture", "ajouter") ?> ">Publier une annonce</a>
                    </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= lien("membre", "ajouter") ?> ">Inscription</a>
                        </li>
   
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- slider begins-->
        <div id="banner" class="carousel slide mb-3" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#banner" data-slide-to="0" class="active"></li>
                <li data-target="#banner" data-slide-to="1"></li>
                <li data-target="#banner" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="uploads/bg.jpg" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="uploads/v1.png" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="uploads/v2.png" class="d-block w-100" alt="banner">
                </div>
                <div class="carousel-item">
                    <img src="uploads/v3.png" class="d-block w-100" alt="banner">
                </div>
            </div>
            <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
        <!-- slider ends-->
        <div class="container">

            <?php
            if (isset($_SESSION["messages"])) {
                foreach ($_SESSION["messages"] as $type => $messages) {
                    foreach ($messages as $msg) {
                        echo "<div class='alert alert-$type alert-dismissible fade show' role='alert'>$msg
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>";
                    }
                }
            }
            unset($_SESSION["messages"]);
            ?>

            <?= $content ?>

        </div>
        <!- fermeteur de container->
            <footer class="text-center mt-5">
                <p>&copy; Consession Automobile- 2021</p>
            </footer>
    </div>
    <!- fermateur de container-fluid->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0498bcf658.js" crossorigin="anonymous"></script>
</body>

</html>