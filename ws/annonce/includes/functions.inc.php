<?php

function redirection($url)
{
    header("Location: $url");
    exit;
}
function ajouterMessage($type, $message)
{
    $_SESSION["messages"][$type][] = $message;
}
function messages($type)
{
    return !empty($_SESSION["messages"][$type]) ? $_SESSION["messages"][$type] : [];
}

function isConnected()
{
    return !empty($_SESSION["membre"]) ? $_SESSION["membre"] : false;
}

function isAdmin()
{
    $membre = isConnected();
    if ($membre && $membre["sattut"] >= 50) {
        return $membre;
    } else {
        return false;
    }
}
function isAbonne()
{
    $membre = isConnected();
    if ($membre && ($membre["sattut"] = 10 && $membre["sattut"] = 30)) {
        return $membre;
    } else {
        return false;
    }
}


function dd($variable)
{

    dump($variable);
    exit;
}
function dump($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function selectAll($tableName)
{
    global $pdo;
    $pdostatement = $pdo->query("SELECT * FROM " . $tableName);
    return $pdostatement !== FALSE ? $pdostatement->fetchAll(PDO::FETCH_ASSOC) : $pdostatement;
}

function selectById($tableName, $id)
{

    global $pdo;
    $pdostatement = $pdo->query("SELECT * FROM $tableName WHERE id = $id");
    if ($pdostatement) {
        return $pdostatement->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

function insertInto(string $table, array $donnees)
{
    $texteRequete = "INSERT INTO $table (";
    $champs = array_keys($donnees);
    $txtChamps = "";
    foreach ($champs as $col) {
        $txtChamps .= ($txtChamps ? ", " : "") . $col;
    }
    $texteRequete .= $txtChamps . ") VALUES (";
    $txtValeurs = "";
    foreach ($champs as $param) {
        $txtValeurs .= ($txtValeurs ? ", " : "") . ":$param";
    }
    $texteRequete .= "$txtValeurs)";

    global $pdo;
    $pdostatement = $pdo->prepare($texteRequete);
    foreach ($donnees as $ind => $valeur) {
        $pdostatement->bindValue(":$ind", $valeur);
    }
    return $pdostatement->execute();
}


function lien($controller, $method, $id = null)
{
    return "?controller=$controller&method=$method" . ($id ? "&id=$id" : "");
}



function livresNonRendus(){
    global $pdo;
    $texteRequete = "SELECT l.id
                     FROM livre l JOIN emprunt e ON l.id = e.livre_id
                     WHERE date_retour IS NULL";
    $pdostatement = $pdo->query($texteRequete);
    return $pdostatement->fetchAll(PDO::FETCH_COLUMN);
}

function EmpruntsParAbonneId(int $id){
    global $pdo;
    $texteRequete = "SELECT * FROM emprunt e WHERE abonne_id = $id";
    $requete = $pdo->query($texteRequete);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}