<?php
namespace Modeles;

use Modeles\Entites\Emprunt;
use Modeles\Modele;
use PDO;

class EmpruntModele extends Modele{
    public function selectAll(){
        $pdostatement = self::pdo()->query("SELECT * FROM emprunt");
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Emprunt::class);
    }

    public function selectById(int $id){
        $pdostatement = self::pdo()->query("SELECT * FROM emprunt WHERE id = $id");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Emprunt::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }

    }
    public function insertInto($emprunt){
        $texteRequete = "INSERT INTO emprunt (date_emprunt, date_retour, abonne_id, livre_id) 
                         VALUES (:date_emprunt, :date_retour, :abonne_id, :livre_id)";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":date_emprunt", $emprunt->getDate_emprunt());
        $pdostatement->bindValue(":date_retour", $emprunt->getDate_retour());
        $pdostatement->bindValue(":abonne_id", $emprunt->getAbonne_id());
        $pdostatement->bindValue(":livre_id", $emprunt->getLivre_id());
        return $pdostatement->execute();
 
    }
    public function update($emprunt){
        $texteRequete = "UPDATE livre 
                         SET titre = :titre, auteur = :auteur, couverture = :couverture
                         WHERE id = :id";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":titre", $emprunt->getTitre());
        $pdostatement->bindValue(":auteur", $emprunt->getAuteur());
        $pdostatement->bindValue(":couverture", $emprunt->getCouverture());
        $pdostatement->bindValue(":id", $emprunt->getId());
        return $pdostatement->execute();
    }
    public function delete($emprunt){
        return self::pdo()->exec("DELETE FROM livre WHERE id = " . $emprunt->getId());
    }

    public function selectEmprunts(){
        $texteRequete = "SELECT e.*, a.pseudo, CONCAT(l.titre, ' - ', l.auteur) as livre 
                         FROM emprunt e JOIN abonne a ON e.abonne_id = a.id  
                                          JOIN livre l ON e.livre_id = l.id";
        $pdostatement = self::pdo()->query($texteRequete);
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Emprunt::class);
    }

    public function livresNonRendus(){
        $texteRequete = "SELECT l.id
                            FROM livre l JOIN emprunt e ON l.id = e.livre_id
                            WHERE date_retour IS NULL";
        $pdostatement = self::pdo()->query($texteRequete);
        return $pdostatement->fetchAll(PDO::FETCH_COLUMN);

    }
}