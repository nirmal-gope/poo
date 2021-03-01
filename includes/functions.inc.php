<?php

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

/* EXO : créer une fonction qui renvoie TRUE si un abonné est connecté
                                        FALSE si aucun abonné n'est connecté
empty(0) retourne TRUE
empty(-1) retourne FALSE

empty("") retourne TRUE
empty(" ") retourne FALSE

empty(FALSE) retourne TRUE
empty(TRUE) retourne FALSE

empty([]) retourne TRUE
empty([ [] ]) retourne FALSE

empty($objet) retourne FALSE
                                        */
function isConnected_exo()
{
    /* 1ere solution */
    // if( isset($_SESSION["abonne"]) && $_SESSION["abonne"] != [] ){
    if (!empty($_SESSION["abonne"])) {
        return true;
    } else {
        return false;
    }

    /* 2ième solution */
    $connecte = !empty($_SESSION["abonne"]) ? true : false;
    return $connecte;

    /* 3ième solution */
    return !empty($_SESSION["abonne"]);
}

function isConnected()
{
    // Le résultat qui retourne true ou false
    // return !empty($_SESSION["abonne"]);

    /* EXO : la fonction doit renvoyer false ou les informations de l'abonné connecté sous forme d'array */
    return !empty($_SESSION["abonne"]) ? $_SESSION["abonne"] : false;
}

function redirection($url)
{
    header("Location: $url");
    exit;
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


/* BASE DE DONNES
Retourne un array contenant tous les enregistrements d'une table de la base de données
*/
function selectAll($tableName)
{
    global $pdo; //making $pdo variable global to local
    $pdostatement = $pdo->query("SELECT * FROM " . $tableName);
    /*
    if ($pdostatement !== FALSE) {
        return $pdostatement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
*/
    return $pdostatement !== FALSE ? $pdostatement->fetchAll(PDO::FETCH_ASSOC) : $pdostatement;
}


/**Faire une fonction qui retourne un enregistrement selon une table dinnée et un identifiant
 * par exemple:
 * selectionne("livre", 2) retourne le livre dont l'id vaut 2
 *
 */
function selectById($tableName, $id)
{
    global $pdo;
    $pdostatement = $pdo->query("SELECT * FROM  $tableName WHERE id = $id");
    if($pdostatement){
        return $pdostatement->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
    /*
    return $pdostatement !== FALSE ? $pdostatement->fetch(PDO::FETCH_ASSOC) : $pdostatement;
    */
}


/*Message d'alerte
* @param string $type Equivalent à la classe Bootstrap
* @param string $message message à afficher
*/
function ajouterMessage($type, $message){
$_SESSION["messages"][$type][] = $message;
}

/**
 * Liste des messages d'alerte en attente
 * @return array
 */

function messages($type){
    /*
    if(!empty($_SESSION["messages"][$type])){
        return $_SESSION["message"][$type];
    }else{
        return [];
    }
    */
    return !empty($_SESSION["messages"][$type]) ? $_SESSION["messages"][$type] : [];
}

function livresNonRendus(){
    global $pdo;
    $texteRequete = "SELECT l.id
    FROM livre l JOIN emprunt e ON l.id = e.livre_id
     date_retour IS NULL";
    $pdostatement = $pdo->query($texteRequete);
    return $pdostatement->fetchAll(PDO::FETCH_ASSOC);
}