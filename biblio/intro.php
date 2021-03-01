<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, td, th{
            border: 1px solid;
            border-collapse: collapse;
        }

        td, th{
            padding: 5px 10px;
        }
        th{
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <h1>COURS de PHP</h1>
    <?php
        /* COMMENTAIRES 
            La balise PHP : <?php   ?>
            Commentaires  /*  */

        // commentaires sur 1 ligne
        # commentaires sur 1 ligne

        /* Toutes les instructions PHP se terminent par un ; 
        echo : fonction PHP qui affiche le contenu d'une variable ou une valeur 

        Une chaîne de caractère est délimitée par des ' ou des " (string)
        Booléens : 2 valeurs possibles : true, false

        En PHP, la déclaration et l'affection d'une nouvelle variable se fait toujours en meme temps
        Une variable commence par le caractère $
        */
        echo "Hello world !";
        $nb = 5;
        echo "<br>J'ai déclaré la variable nb et je lui ai affecté la valeur 5<br>";
        $test = "Je suis un test<br>";
        echo $test;

        echo "<h2 style='color: red'>Titre \"H2\"</h2>\\";

        /* CONCATENATION : symbole . */
        echo "Le contenu de la variable test est : " . $test;

        echo "La valeur de la variable test est : $test";
        echo 'La valeur de la variable test est : $test';
        echo '<hr>';
        echo 'La valeur de la variable $nb est ' . $nb . '<br>';
        echo "La valeur de la variable \$nb est $nb <br>";

        /* Nommage des variables 
            Caractères autorisés : az AZ 09 _
            Une variable ne commence JAMAIS par un chiffre
            Interdiction d'utiliser des mots réservés (ex: this, return, function,...)
            Les noms de variables sont sensibles à la casse (= case sensitive) : différence entre MAJUSCULES et minuscules
            camelCase : $nomDeLaVariable
            snake_case : $nom_de_la_variable
            Kebab-case : nom-de-variable
        */
        $nom = "Cérien";
        $Nom = "Aymar";
        echo $nom . ' ' . $Nom . "<br>";
    ?>

    <h2>CONSTANTES</h2>
    <?php
        /* Pour définir une constante, on utilise la fonction define
            define("NOM_DE_LA_CONSTANTE", "valeur de la constante");
           Convention de nommage : tout en MAJUSCULES
        */
        define("CAPITALE", "Paris");
        echo "La capitale de la France est " . CAPITALE . "<br>";
        echo "La capitale de la France est CAPITALE<br>";

        define("TVA", 20);
        // EXO afficher "La TVA vaut ..%"
        echo "La TVA vaut " . TVA . "%";
    ?>

    <h2>Les TABLEAUX</h2>
    <?php
        $tab = array(1, 2, 3, 4); // Déclaration d'un tableau
        $tab = [ 1, 2, 3, 4 ];
        $tableauVide = [];
        // Afficher la 2ième valeur d'un tableau 
        /* Attention, les indices d'un tableau commence à 0 */
        echo $tab[1] . "<br>";

        $tab[2] = "bonjour";
        //echo $tab;
        /* Pour afficher le contenu d'une variable (et avoir des informations sur cette variable), on peut utiliser la fonction var_dump 
            ex: var_dump($tab);
            Ou la fonction print_r
        */
        echo "<pre>";
        var_dump($tab);
        print_r($tab);
        echo "</pre>";

        $tab[9] = true;

        echo "<pre>";
        var_dump($tab);
        echo "</pre>";

        echo $tab[2] . " tout le monde<br>";
        echo $tab[0] + $tab[3] . "<br>";
        // EXO ajouter dans le tableau $tab à l'indice 5 le résultat du calcul de $nb fois 10. Ensuite afficher la valeur de $tab[5]
        $tab[5] = $nb * 10;
        echo $tab[5] . "<br>";
        echo "<pre>";
        var_dump($tab);
        echo "</pre>";

        /* On ajoute une valeur à la variable $tab */
        $tab[] = "une nouvelle valeur";
        echo "<pre>";
        var_dump($tab);
        echo "</pre>";

        /* EXO : ajoutez votre prénom à l'array $tab 
                2. affichez "bonjour prenom" avec les valeurs de l'array $tab
        */
        $tab[] = "Didier";
        echo $tab[2] . " " . $tab[11] . "<br>";

        echo "<hr>";
        /*
            EXO : déclarez un nouveau tableau ($tab2) avec les valeurs suivantes :
                    14, 2, "au revoir", false, "test"
        */
        $tab2 = [ 14, 2, "au revoir", false, "test" ];
        $tab2[] = "Didier";

        /* La taille d'un tableau : fonction COUNT($tableau) */
        $taille = count($tab2);
        echo $tab2[2] . " " . $tab2[ $taille - 1 ];  // le dernier élément du tableau se trouve à l'indice qui correspond à la taille du tableau moins 1
                                                     // parce que le 1er indice du tableau est 0
    ?>

    <h2>Les tableaux associatifs</h2>
    <?php
        $personnage = [ "prenom" => "Peter", "nom" => "Parker" ];
        echo "<pre>"; print_r($personnage); echo "</pre>";

        echo "Mon personnage s'appelle " . $personnage["prenom"] . " " . $personnage["nom"] . "<br>";
        echo $personnage[0];
        $personnage[] = 7;
        echo "<pre>"; print_r($personnage); echo "</pre>";
        
        $personnage["pseudo"] = "Spiderman";
        echo "<pre>"; print_r($personnage); echo "</pre>";

        $personnage["pseudo"] = "Venom";
        echo "<pre>"; print_r($personnage); echo "</pre>";

        // echo $personnage["pseudo"];

        $personnage2 = [ "nom" => "Stark", "prenom" => "Tony", "pseudo" => "Iron Man" ];

        $listePersonnages[] = $personnage;
        $listePersonnages[] = $personnage2;
        echo "<pre>"; var_dump($listePersonnages); echo "</pre>";
        /*
        
    []
    [
        nom
        prenom
        pseudo
    ]

    [
        0 => [ nom, prenom , pseudo ],
        1 => [ nom prenom pseudo ]
    ]

            QUESTIONS : quelle est le type de variable de la variable $listePersonnages ?
                        quelle est la taille de $listePersonnages ?
        */

    $hulk = [
        "nom" => "Banner",
        "prenom" => "Bruce",
        "pseudo" => "Hulk"
    ];

    $listePersonnages[] = $hulk;
    $listePersonnages[] = [
        "prenom" => "Natacha",
        "nom" => "Romanov",
        "pseudo" => "Black Widow"
    ];

    // QUESTION : Affichez le pseudo du 1er personnage de la listePersonnage
        echo "<hr>";
        echo "<pre>"; print_r($listePersonnages); echo "</pre>";
        echo "Le pseudo du 1er personnage est " . $listePersonnages[0]["pseudo"] . "<br>"; 
        // $perso = $listePersonnages[0];
        // echo $perso["pseudo"];

    ?>

    <h2>OPERATEURS</h2>
    <h3>Opérateurs arithmétiques</h3>
    <?php
        echo "Addition : " . (5 + 2) . "<br>";
        echo "Multiplication" . (5 * 2) . "<br>";
        echo "Soutraction : " . (5 - 2) . "<br>";
        echo "Division :" . (5 / 2) . "<br>";

        echo "<h3>Incrémentation/ Décrementation</h3>";
        $i = 5;
        $i++;
        $i = $i + 1;
        echo '<p>$i++ est équivalent à $i = $i + 1</p>';

        $i+=3;
        echo '<p>$i+=3 est équivalent à $i = $i + 3</p>';

        $i--;
        echo '<p>$i-- est équivalent à $i = $i - 1</p>';

        echo "<p>On peut utiliser la notation raccourci avec * et / : </p>";
        $i *= 5;
        echo '<p>$i *= 5 est équivalent à $i = $i * 5</p>';

        echo "<p>On peut aussi l'utiliser avec la concaténation : </p>";
        $texte = "bonjour ";
        $texte .= "tout le monde";

        echo '<p>$texte .= "tout le monde" est équivalent à $texte = $texte . "tout le monde" </p>';
    ?>
    <h3>Opérateurs de comparaison</h3>
    <p><, <=, >, >= </p>

    <h3>Opérateurs d'égalité</h3>
    <p>égalité == </p>
    <p>égalité stricte === : l'égalité stricte est vraie si les valeurs et les types sont égaux</p>
    <?php
        $a = 10;
        $b = "10";
        echo "<p>$a == $b est vrai</p>";
        echo "<p>$a === '$b' est faux parce que \$a est un entier et \$b est un string</p>";
    ?>

    <h3>Opérateurs logiques</h3>
    <ul>
        <li>&& (and)</li>
        <li>|| (or)</li>
        <li>! (not)</li>
    </ul>

    <h2>STRUCTURES CONDITIONNELLES</h2>
    <h3>IF... ELSEIF... ELSE</h3>
    <?php
        /* syntaxe: if(condition) { ... } elseif(condition) { ... } else { ... }  
        condition est un booléen
        */
        $age = 55;
        if( $age < 18 ) {
            echo "Vous êtes mineur<br>";
        } else {
            echo "Vous êtes majeur<br>";
        }

        if( $age < 10 ) {
            echo "Tu es un(e) gamin(e)<br>";
        } elseif( $age < 18 ){
            echo "Vous êtes un(e) ado<br>";
        } elseif( $age < 30 ){
            echo "Vous êtes encore jeune<br>";
        } else {
            echo "Vous êtes vieux<br>";
        }
        

        $a = 10;
        $b = 5;
        $c = 2;

        // ET 
        if ($a > $b && $b > $c){
            echo "les 2 conditions sont vraies<br>";
        } else {
            echo "au moins 1 des 2 conditions est fausse<br>";
        }

        // OU
        if ($a > $b || $b > $c){
            echo "Au moins 1 des 2 conditions est vraie<br>";
        } else {
            echo "les 2 conditions sont fausses<br>";
        }

        /* ! (not) inverse la valeur d'un booléen 
            !true est égal à false
            !false est égal à true

            !($a > $b)   est équivalent à   ($a <= $b)
        */
        if( !($a > $b) ){
            echo "la condition ($a > $b) est fausse<br>";
        } else {
            echo "la condition ($a > $b) est vraie<br>";
        }


        ?>
        <h3>SWITCH</h3>
        <?php
            $taille = "L";
            switch($taille){
                case "XS":
                case "S":
                    echo "S correspond à Small<br>";
                break;

                case "M":
                    echo "M correspond à Medium<br>";
                break;

                case "L" :
                    echo "L correspond à Large<br>";
                break;

                case "XL":
                    echo "XL correspond à eXtra Large<br>";
                break;

                default:
                    echo "$taille ne correspond pas à une taille standard<br>";
            }

            // EXO : transformez le SWITCH ci-dessus en IF
            if($taille == "XS" || $taille == "S"){
                echo "S correspond à Small<br>";
            } elseif($taille == "M"){
                echo "M correspond à Medium<br>";
            } elseif($taille == "L"){
                echo "L correspond à Large<br>";
            } elseif($taille == "XL"){
                echo "XL correspond à eXtra Large<br>";
            } else {
                echo "$taille ne correspond pas à une taille standard<br>";
            }
        ?>

        <h2>STRUCTURES ITERATIVES</h2>
        <h3>Boucle WHILE</h3>
        <?php
            //EXO :  Affichez les nombres de 1 à 10 en utilisant une boucle WHILE
            $i = 1;
            while($i <= 10){
                // echo $i++ . " - ";
                echo $i . " - ";
                $i++;
            }
            echo "$i <br>";        
        ?>

        <h3>Boucle DO... WHILE</h3>
        <?php
            $i = 11;
            while($i <= 10){
                echo $i++ . " - ";
            }
            
            echo "<p>avec do while</p>";
            do {
                echo $i++ . " - ";
            } while ($i <= 10);
        ?>

        <h3>Boucle FOR</h3>
        <?php 
           for($i = 1; $i <= 10; $i++){
            echo $i++ . " - ";
        } 
        echo "<br>";
        for($i = 1; $i <= 10; $i+=2){
            echo $i . " - ";
        } 
  ?>
  <h3>Boucle FOREACH</h3>
  <?php
    /* La boucle FOREACH s'utilise pour parcourir toutes les valeurs d'un tableau
    syntaxe : 
        foreach($tableau as $valeur){}
    ou
        foreach($tableau as $indice => $valeur){}

    $tablau correspond à l'array que l'on veut parcourir
    $valeur correspond à la variable qui va valoir chaque valeur de l'array
                A chaque tour de boucle, $valeur vaudra la valeur suivante de l'array
    $indice corresponde à la variable qui vaudra chaque indice du tableau. Cela permet
                de savoir à quelle itération on se trouve
    */
    $tab = [ 23, 45, 67, 13 ];
    
    foreach($tab as $valeur){
        echo $valeur . "/";
    }
    echo "<br>";
    echo "<p>Avec les indices</p>";
    foreach($tab as $indice => $valeur){
        echo $indice . " : " . $valeur . "<br>";
        echo "<strong>" . $indice . " : " . $tab[$indice] . "</strong><br><br>";
    }

    // EXO : affichez les indices et les valeurs de $tab dans une table HTML
    //       avec une colonne "indice" et une colonne "valeur"

    echo "<table>";
    echo "<tr>
            <th>Indices</th>
            <th>Valeurs</th>
        </tr>"; 
    foreach($tab as $ind => $val){
        echo "<tr>";
        echo "<td>$ind</td>";
        echo "<td>$val</td>";
        echo "</tr>";
    }   
    echo "</table>";

    // EXO : affichez de la même façon, la variable $personnage
    echo "<hr><table>";
    echo "<tr><th colspan=2>Personnage</th></tr>
            <tr>
            <th>Indices</th>
            <th>Valeurs</th>
        </tr>"; 
    foreach($personnage as $ind => $val){
        echo "<tr>";
        echo "<td>$ind</td>";
        echo "<td>$val</td>";
        echo "</tr>";
    }   
    echo "</table>";
    
  ?>

    <hr>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Pseudo</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><?php echo $personnage["prenom"] ?></td>
                <td><?php echo $personnage["nom"] ?></td>
                <td><?php echo $personnage["pseudo"] ?></td>
            </tr>
        </tbody>
    </table>

    <hr>
    
    <pre><?php print_r($listePersonnages) ?></pre>

    <h3>Liste des personnages</h3>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Pseudo</th>
            </tr>
        </thead>

        <tbody>
            <!-- Pour chaque personnage de la variable listePersonnage -->
            <?php foreach($listePersonnages as $perso): ?>
                <tr>
                    <td><?php echo $perso["prenom"] ?></td>
                    <td><?php echo $perso["nom"] ?></td>
                    <td><?php echo $perso["pseudo"] ?></td>
                </tr>
            <?php endforeach; ?>
            <!--  -->
        </tbody>
    </table>


<!--
<table>
    <tr>             TR : Table Row (ligne)
        <th></th>   TH : Table Header (entête)
        <th></th>
    </tr>

    <tr>
        <td></td>   TD : Table Data (cellule ou case)
        <td></td>
    </tr>
</table>
-->

    <h2>LES FONCTIONS</h2>
    <?php
        /* Le but d'une fonction est d'écrire du code qui va pouvoir être rappelé
            au besoin à plusieurs endroit du code source.
            
            Une fonction peut renvoyer une valeur avec le mot-clé 'return'
            
            Une fonction peut utiliser des paramètres dont elle a besoin pour être
            exécutée. Les valeurs de ces paramètres seront fournies lors de l'appel de
            cette fonction

            Dans l'exemple, la fonction nommée carre a un paramètre $nb. Cette fonction
            retourne $nb au carré
        */

        function carre(int $nb) {
            return $nb * $nb;
            echo "Cette instruction ne sera jamais exécutée parce qu'elle est après le 'return'";
        }

        $a = 5;
        $resultat = carre($a);
        echo "Le carré de $a est égal à $resultat<br>";

        echo "Le carré de 9 est égal à " . carre(9) . "<br>";

        // EXO : affichez les carrés de tous les nombres de 0 à 99
        /* ex: 1x1 = 1
               2x2 = 4
               3x3 = 9
        */
        for($i = 0; $i<=99; $i++){
            echo $i . "x" . $i . " = " . carre($i) . "<br>";
        }

        // EXO : écrire une fonction qui remplace echo. Elle attend 1 paramètre
        // La fonction affiche ce paramètre suivi d'un "<br>"
        // afficher("une phrase"); 
        //          => une phrase<br>

        function afficher($chaine){
            echo $chaine . "<br>";
        }

        afficher("Le carré de $a est égal à " . carre($a) . ".");
        echo "test";
    ?>

</body>
</html>