<?php

namespace Models;

use PDO, Exception;

abstract class Model
{

    static public function pdo()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=consession", "root", "");
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
