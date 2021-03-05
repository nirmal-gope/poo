<?php
namespace Modeles;

use Modeles\Entites\Abonne;
use PDO;

class AbonneModele extends Modele{
    public function selectAll(){
        $pdostatement = self::pdo()->query("SELECT * FROM abonne");
        // return $pdostatement->fetchAll(\PDO::FETCH_CLASS, "Modeles\Entites\Abonne");
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Abonne::class);
    }

    public function selectById(int $id){
        $pdostatement = self::pdo()->query("SELECT * FROM abonne WHERE id = $id");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Abonne::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }

    public function insertInto($abonne)
    {}
    
    public function update($abonne)
    {
        # code...
    }

    public function delete($abonne)
    {
        # code...
    }

    public function selectByPseudo($pseudo)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM abonne WHERE pseudo = \"$pseudo\"");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Abonne::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }
    

}