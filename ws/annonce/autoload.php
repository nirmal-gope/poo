<?php
function autoloadClass($class)
{
    $class = str_replace("\\", "/", $class);
    include $class . ".php";
}
spl_autoload_register("autoloadClass");
