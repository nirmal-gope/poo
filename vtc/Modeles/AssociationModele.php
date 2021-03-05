<?php

namespace Modeles;

use Modeles\Entites\Association;
use Modeles\Modele;
use PDO;

class AssociationModele extends Modele
{
    public function selectAll()
    {
        $pdostatement = self::pdo()->query("SELECT * FROM association_vehicule_conducteur");
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Association::class);
    }

    public function selectById(int $id_association)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM association_vehicule_conducteur WHERE id_association = $id_association");
        if ($pdostatement) {
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Association::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }
    public function insertInto($association)
    {
        $texteRequete = "INSERT INTO association_vehicule_conducteur (id_vehicule, id_conducteur) 
                         VALUES (:id_vehicule, :id_conducteur)";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":id_vehicule", $association->getId_vehicule());
        $pdostatement->bindValue(":id_conducteur", $association->getId_conducteur());
        return $pdostatement->execute();
    }
    public function update($association)
    {
        $texteRequete = "UPDATE association_vehicule_conducteur 
                         SET id_vehicule = :id_vehicule, id_conducteur = :id_conducteur
                         WHERE id_association = :id_association";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":id_vehicule", $association->getId_vehicule());
        $pdostatement->bindValue(":id_conducteur", $association->getId_conducteur());
        $pdostatement->bindValue(":id_association", $association->getId_association());
        return $pdostatement->execute();
    }
    public function delete($association)
    {
        return self::pdo()->exec("DELETE FROM association_vehicule_conducteur WHERE id_association = " . $association->getId_association());
    }
}
