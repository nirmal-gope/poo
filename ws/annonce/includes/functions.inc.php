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
    // SELECT * FROM abonne WHERE id = 2
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
    $champs = array_keys($donnees); // array_keys retourne un array contenant les indices de $donnees
    $txtChamps = "";
    foreach ($champs as $col) {
        $txtChamps .= ($txtChamps ? ", " : "") . $col;  // si txtChamps n'est pas vide, on ajoute une , sinon rien puis on ajoute le nom du champ
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

function lien($controleur, $methode, $id = null)
{
    return "?controleur=$controleur&methode=$methode" . ($id ? "&id=$id" : "");
}
