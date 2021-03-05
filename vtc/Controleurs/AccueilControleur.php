<?php

namespace Controleurs;

use Modeles\AssociationModele;
use Modeles\ConducteurModele;

class AccueilControleur extends BaseControleur
{
    public function index()
    {
        $ConducteurModele = new ConducteurModele;
        $conducteurs = $ConducteurModele->selectAll();

        return $this->rendu("accueil/index.html.php");
    }
}
