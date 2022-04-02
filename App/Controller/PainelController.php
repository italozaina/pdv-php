<?php

namespace App\Controller;

use \Core\View;
use \App\Model\Usuario;

/**
 * PainelController landpages, dashboards
 *
 */
class PainelController extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $usuario = $_SESSION['usuarioLogado'];
        View::renderTemplate('Painel/index.html', ['usuario'=>$usuario]);
    }
}