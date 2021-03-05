<?php

function chargerClasse($classe)
{

    $classe = str_replace("\\", "/", $classe);
    include $classe . ".php";
}

spl_autoload_register("chargerClasse");
