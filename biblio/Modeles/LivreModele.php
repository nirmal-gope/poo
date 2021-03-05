<?php
namespace Modeles;
use PDO;
use Modeles\Entites\Livre;

class LivreModele extends Modele{
    public function selectAll(){
        $pdostatement = self::pdo()->query("SELECT * FROM livre");
        return $pdostatement->fetchAll(\PDO::FETCH_CLASS, "Modeles\Entites\Livre");
    }

    public function selectById(int $id){
        $pdostatement = self::pdo()->query("SELECT * FROM livre WHERE id = $id");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Livre::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }

    public function insertInto($livre)
    {
       $texteRequete = "INSERT INTO livre (titre, auteur, couverture) VALUES (:titre, :auteur, :couverture)";
       $pdostatement = self::pdo()->prepare($texteRequete);
       $pdostatement->bindValue(":titre", $livre->getTitre());
       $pdostatement->bindValue(":auteur", $livre->getAuteur());
       $pdostatement->bindValue(":couverture", $livre->getCouverture());
       return $pdostatement->execute();
    }

    public function update($livre){
        $texteRequete = "UPDATE livre 
                         SET titre = :titre, auteur = :auteur, couverture = :couverture
                         WHERE id = :id";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindValue(":titre", $livre->getTitre());
        $pdostatement->bindValue(":auteur", $livre->getAuteur());
        $pdostatement->bindValue(":couverture", $livre->getCouverture());
        $pdostatement->bindValue(":id", $livre->getId());
        return $pdostatement->execute();
    }

    public function delete($livre)
    {
        return self::pdo()->exec("DELETE FROM livre WHERE id = " . $livre->getId());
    }
}