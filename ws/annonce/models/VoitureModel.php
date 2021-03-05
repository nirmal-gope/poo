<?php

namespace Models;

use Models\Entities\Voiture;
use PDO;

class VoitureModel extends Model
{
    public function selectAll()
    {
        $pdostatement = self::pdo()->query("SELECT * FROM voitures");
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Voiture::class);
    }
    public function selectById(int $id)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM voitures WHERE id =$id"); {
            if ($pdostatement) {
                $pdostatement->setFetchMode(PDO::FETCH_CLASS, Voiture::class);
                return $pdostatement->fetch();
            } else {
                return false;
            }
        }
    }
    public function insertInto($voiture)
    {
        $texteRequete = "INSERT INTO voitures (marque, kilometrage, tarif, photo, fiche) VALUES (:marque, :kilometrage, :tarif, :photo, :fiche)";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":marque", $voiture->getMarque());
        $pdostatement->bindValue(":kilometrage", $voiture->getKilometrage());
        $pdostatement->bindValue(":tarif", $voiture->getTarif());
        $pdostatement->bindValue(":photo", $voiture->getPhoto() ?? null);
        $pdostatement->bindValue(":fiche", $voiture->getFiche() ?? null);
        return $pdostatement->execute();
    }

    public function update($voiture)
    {
        $texteRequete = "UPDATE voitures
                         SET marque = :marque, kilometrage = :kilometrage, tarif = :tarif, photo = :photo, fiche = :fiche
                         WHERE id = :id";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":marque", $voiture->getMarque());
        $pdostatement->bindValue(":kilometrage", $voiture->getKilometrage());
        $pdostatement->bindValue(":tarif", $voiture->getTarif());
        $pdostatement->bindValue(":photo", $voiture->getPhoto());
        $pdostatement->bindValue(":fiche", $voiture->getFiche());
        $pdostatement->bindValue(":id", $voiture->getId());
        return $pdostatement->execute();
    }

    public function delete($voiture)
    {
        return self::pdo()->exec("DELETE FROM voitures WHERE id = $voiture->getId()");
    }
}
