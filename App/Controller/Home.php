<?php

namespace App\Controller;

use \Core\View;
use \App\Model\Usuario;

/**
 * Home controller
 *
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

        $metodoHTTP = $_SERVER['REQUEST_METHOD'];

        View::renderTemplate('Home/nova.html', ['usuarios'=>$result, 'metodo'=> $metodoHTTP]);
    }    

    /**
     * exemplo de tratar e renderizar com variavel de rota
     *
     * @return void
     */
    public function umUsuarioAction()
    {
        $usuarioDAO = new Usuario();        

        $result = $usuarioDAO->getOne($this->route_params['id']);

        $metodoHTTP = $_SERVER['REQUEST_METHOD'];

        View::renderTemplate('Usuario/ver-usuario.html', ['usuario'=>$result, 'metodo'=> $metodoHTTP]);
    }    
}