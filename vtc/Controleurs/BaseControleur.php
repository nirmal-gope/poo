<?php

namespace Controleurs;

class BaseControleur
{
    public function rendu($vue, array $parametresVue = [])
    {
        extract($parametresVue);
        ob_start();
        include "vues/" . $vue;
        $contenu = ob_get_contents();
        ob_end_clean();
        include_once "vues/base.html.php";
    }
}
