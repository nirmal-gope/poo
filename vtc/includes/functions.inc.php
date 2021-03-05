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
    if (!empty($_SESSION["messages"][$type])) {
        return $_SESSION["messages"][$type];
    } else {
        return [];
    }
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

function lien($controleur, $methode, $id = null)
{
    return "?controleur=$controleur&methode=$methode" . ($id ? "&id=$id" : "");
}
