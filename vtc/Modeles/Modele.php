<?php

namespace Modeles;

use PDO, Exception;


abstract class Modele
{

    static public function pdo()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=vtc", "root", "");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $pdo;
    }


    abstract public function selectAll();
    abstract public function selectById(int $id);
    abstract public function insertInto($objet);
    abstract public function update($objet);
    abstract public function delete($objet);
}
