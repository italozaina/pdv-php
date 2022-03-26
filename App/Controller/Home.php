<?php

namespace App\Controller;

use \Core\View;
use \App\Model\Usuario;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }

    /**
     * Show the nova page
     *
     * @return void
     */
    public function novaAction()
    {        
        $usuarioDAO = new Usuario();
        // $usuarioDAO->criarTabela();
        // $usuarioDAO->dadosIniciais();
        $result = $usuarioDAO->getAll();
        View::renderTemplate('Home/nova.html', ['usuarios'=>$result]);
    }    
}