<?php
include_once "includes/init.inc.php";

if($_GET){
    if(!empty($_GET["controller"])){
        $nameController = $_GET["controller"];
    }else{
        $nameController = "accueil";
    }
    if(!empty($_GET["method"])){
        $method = $_GET["method"];
    }else{
        $method = $nameController == "accueil" ? "index" : "list";
    }
    $id = !empty($_GET["id"]) ? $_GET["id"] : null;
}else{
    $nameController = "accueil";
    $method = "index";
    $id = null;
}
$classController = "Controllers\\" . ucfirst($nameController) . "Controller";
$controller = new $classController;
$controller->$method($id);