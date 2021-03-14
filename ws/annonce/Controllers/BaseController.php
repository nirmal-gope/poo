<?php
namespace Controllers;

class BaseController
{
    public function render($view, array $parametersView = [])
    {
        extract($parametersView);
        ob_start();
        include "views/" . $view;
        $content = ob_get_contents();
        ob_end_clean();
        include_once "views/base.html.php";
    }
}
