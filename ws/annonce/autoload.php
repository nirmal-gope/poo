<?php
function loadClass($class)
{
    $class = str_replace("\\", "/", $class);
    include $class . ".php";
}
spl_autoload_register("loadClass");
