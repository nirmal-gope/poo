<?php

namespace Modeles;

use Modeles\Entites\Vechicule;
use PDO;


class VechiculeModele extends Modele
{
    public function selectAll()
    {
        $pdostatement = self::pdo()->query("SELECT * FROM vehicule");
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Vechicule::class);
    }

    public function selectById(int $id_vehicule)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM vehicule WHERE id_vehicule = $id_vehicule");
        if ($pdostatement) {
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Vechicule::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }

    public function insertInto($vechicule)
    {
        $texteRequete = "INSERT INTO vehicule (marque, modele, couleur, immatriculation) VALUES (:marque, :modele, :couleur, :immatriculation)";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":marque", $vechicule->getMarque());
        $pdostatement->bindValue(":modele", $vechicule->getModele());
        $pdostatement->bindValue(":couleur", $vechicule->getCouleur());
        $pdostatement->bindValue(":immatriculation", $vechicule->getImmatriculation());

        return $pdostatement->execute();
    }

    public function update($vechicule)
    {
        $texteRequete = "UPDATE vehicule 
                         SET marque = :marque, modele = :modele, couleur = :couleur, immatriculation = :immatriculation
                         WHERE id_vehicule = :id_vehicule";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":marque", $vechicule->getMarque());
        $pdostatement->bindValue(":modele", $vechicule->getModele());
        $pdostatement->bindValue(":couleur", $vechicule->getCouleur());
        $pdostatement->bindValue(":immatriculation", $vechicule->getImmatriculation());
        $pdostatement->bindValue(":id_vehicule", $vechicule->getId_vehicule());
        return $pdostatement->execute();
    }

    public function delete($vechicule)
    {
        return self::pdo()->exec("DELETE FROM vehicule WHERE id_vehicule = $vechicule->getId_vehicule()");
    }
}
