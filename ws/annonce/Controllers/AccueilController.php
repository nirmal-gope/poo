<?php
namespace Controllers;
use Models\VoitureModel;
use Models\MembreModel;

class AccueilController extends BaseController{
    public function index(){
        //  $VoitureModel = new VoitureModel;
        // $$voitures = $VoitureModel->selectAll();

        return $this->render("accueil/index.html.php");

    }
}