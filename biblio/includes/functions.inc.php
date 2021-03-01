<?php

function dateFr($datestr)
{
    return $datestr ? date("d/m/y", strtotime($datestr)) : "";
}

function dump($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function dd($variable)
{
    // Dump and die
    dump($variable);
    exit;
}

// UTILSATEUR
function isConnected()
{
    return !empty($_SESSION["abonne"]) ? $_SESSION["abonne"] : false;
}

function isAdmin()
{
    $abonne = isConnected();
    if ($abonne && $abonne["niveau"] >= 50) {
        return $abonne;
    } else {
        return false;
    }
}


function redirection($url)
{
    header("Location: $url");
    exit;
}


/**
 * Message d'alerte
 * @param string $type Equivalent à la classe Bootstrap
 * @param string $message Message à afficher
 */
function ajouterMessage($type, $message)
{
    $_SESSION["messages"][$type][] = $message;
}

/**
 * Liste des messages d'alerte en attente
 * @return array
 */
function messages($type)
{
    if (!empty($_SESSION["messages"][$type])) {
        return $_SESSION["messages"][$type];
    } else {
        return [];
    }
    //return !empty($_SESSION["messages"][$type]) ? $_SESSION["messages"][$type] : [];
}

/* BASE DE DONNEES */

/**
 * Retourne un array contenant tous les enregistrements d'une table de la base de données
 * Le nom de la table est dans la variable $tableName
 */
function selectAll($tableName)
{

    global $pdo;
    $pdostatement = $pdo->query("SELECT * FROM " . $tableName);
    // if( $pdostatement !== FALSE ){
    //     return $pdostatement->fetchAll(PDO::FETCH_ASSOC);
    // } 
    // return false;
    return $pdostatement !== FALSE ? $pdostatement->fetchAll(PDO::FETCH_ASSOC) : $pdostatement;
}

/**
 * Faire une fonction qui retourne un enregistrement selon une table donnée et un identifiant
 * par exemple 
 *      selectById("livre", 2) retourne le livre dont l'id vaut 2
 */
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


function livresNonRendus()
{
    global $pdo;
    $texteRequete = "SELECT l.id
                     FROM livre l JOIN emprunt e ON l.id = e.livre_id
                     WHERE date_retour IS NULL";
    $pdostatement = $pdo->query($texteRequete);
    return $pdostatement->fetchAll(PDO::FETCH_COLUMN);
}

function EmpruntsParAbonneId(int $id)
{
    global $pdo;
    $texteRequete = "SELECT * FROM emprunt e WHERE abonne_id = $id";
    $requete = $pdo->query($texteRequete);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function insertInto(string $table, array $donnees)
{
    $texteRequete = "INSERT INTO $table (";
    $champs = array_keys($donnees); //array_keys retourne un array contenant les indices de donnees
    $txtChamps = "";
    foreach ($champs as $col) {
        $txtChamps .= ($txtChamps ? ", " : "") . $col; //si txtChamps n'est pas vide, on ajouter une, sinon rien puis on ajoute le nom du champ
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
        $pdostatement->bindvalue(":$ind", $valeur);
    }
    return $pdostatement->execute();
}

function lien($controleur, $methode, $id = null)
{
    return "?controleur=$controleur&methode=$methode" . ($id ? "&id=$id" : "");
}
