<?php

namespace Modeles;

use Modeles\Entites\Conducteur;
use PDO;

class ConducteurModele extends Modele
{
    public function selectAll()
    {
        $pdostatement = self::pdo()->query("SELECT * FROM conducteur");
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Conducteur::class);
    }

    public function selectById(int $id_conducteur)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM conducteur WHERE id_conducteur = $id_conducteur");
        if ($pdostatement) {
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Conducteur::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }

    public function insertInto($conducteur)
    {
        $texteRequete = "INSERT INTO conducteur (prenom, nom) VALUES (:prenom, :nom)";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":prenom", $conducteur->getPrenom());
        $pdostatement->bindValue(":nom", $conducteur->getNom());
        return $pdostatement->execute();
    }

    public function update($conducteur)
    {
        $texteRequete = "UPDATE conducteur 
                         SET prenom = :prenom, nom = :nom
                         WHERE id_conducteur  = :id_conducteur";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":prenom", $conducteur->getPrenom());
        $pdostatement->bindValue(":nom", $conducteur->getNom());
        $pdostatement->bindValue(":id_conducteur", $conducteur->getId_conducteur());
        return $pdostatement->execute();
    }

    public function delete($conducteur)
    {
        return self::pdo()->exec("DELETE FROM conducteur WHERE  id_conducteur = " . $conducteur->getId_conducteur());
    }
}
