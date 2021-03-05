<?php
namespace Controleurs;

use Modeles\EmpruntModele;
use Modeles\LivreModele;

class AccueilControleur extends BaseControleur{
    public function index()
    {
        $livreModele = new LivreModele;
        $livres = $livreModele->selectAll();

        $empruntModele = new EmpruntModele;
        $livresNonRendus = $empruntModele->livresNonRendus();

        $params = [
            "livres" => $livres,
            "livresNonRendus" => $livresNonRendus
        ];
        return $this->rendu("accueil/index.html.php", $params);
    }

}