<?php
session_start(); 
try {
    $pdo = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
} catch (Exception $ex) {
    die($ex->getMessage());
}

include "functions.inc.php";