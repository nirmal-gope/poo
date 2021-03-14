<?php

include "functions.inc.php";

$nb1 = 15; $nb2 = 7;
$resultat = superieur($nb1, $nb2);

if( $resultat ){
    afficher("$nb1 est supérieur à $nb2");
} else {
    afficher("$nb1 est inférieur à $nb2");
}

$nb1 = 52; $nb2 = 324;
if( superieur($nb1, $nb2) ){
    afficher("$nb1 est supérieur à $nb2");
} else {
    afficher("$nb1 est inférieur à $nb2");
}

$nb1 = 9; $nb2 = 10;
if( superieur($nb1, $nb2) ){
    afficher("$nb1 est supérieur à $nb2");
} else {
    afficher("$nb1 est inférieur à $nb2");
}

$nb1 = 4; $nb2 = -52;
if( superieur($nb1, $nb2) ){
    afficher("$nb1 est supérieur à $nb2");
} else {
    afficher("$nb1 est inférieur à $nb2");
}
echo "<hr>";

$exemples = [
    [ 15, 7 ],
    [ 52, 324 ],
    [ 9, 10 ],
    [ 4, -52 ]
];
foreach($exemples as $ex){
    if( superieur($ex[0], $ex[1]) ){
        afficher($ex[0] . " est supérieur à " . $ex[1]);
    } else {
        afficher($ex[0] . " est inférieur à " . $ex[1]);
    }
}
