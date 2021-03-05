<?php
namespace Modeles;
use PDO, Exception;

/* Une classe abstraite est une classe qui ne peut pas être instanciée 
    Pour déclarer une classe abstraite, il faut utiliser le mot-clé 'abstract'
    avant le mot 'class'
*/
abstract class Modele{
    /* La méthode pdo() va retourner un objet de la classe PDO */
    static public function pdo()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $pdo;
    }

    /* Une méthode abstraite est une méthode qui n'a pas de code, il n'y a
        que la déclaration.
        Une méthode abstraite ne peut exister que dans une classe abstraite
        Si une classe hérite d'une classe qui contient des méthodes abstraites,
        il faut absolument déclarer ces classes abstraites dans la classe qui 
        hérite.
    */
    abstract public function selectAll();
    abstract public function selectById(int $id);
    abstract public function insertInto($objet);
    abstract public function update($objet);
    abstract public function delete($objet);
}