<?php
session_start(); // Il faut exécuter cette fonction si on veut utiliser la variable superglobale $_SESSION
try {
    $pdo = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
} catch (Exception $ex) {
    die($ex->getMessage());
}

include "functions.inc.php";