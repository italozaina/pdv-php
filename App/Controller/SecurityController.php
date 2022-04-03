<?php

namespace App\Controller;

use \Core\View;
use \App\Model\Usuario;

/**
 * SecurityController logar e deslogar do sistema
 *
 */
class SecurityController extends \Core\Controller
{

    /**
     * Página de login
     *
     * @return void
     */
    public function loginAction()
    {
        $resp=NULL;
        $usuarioDAO = new Usuario();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dados = $_POST;
            $dados['senha'] = md5($dados['senha']);
            $test = $usuarioDAO->logar($dados);
            if($test){                
                $_SESSION['usuarioLogado'] = $test;
                header('Location: /painel');
	            exit;
            }else{
                $resp = "Credenciais inválidas.";
            }
            View::renderTemplate('Login/login.html', ['resp'=>$resp]);
        }

        View::renderTemplate('Login/login.html', ['resp'=>$resp]);
    }

    /**
     * Deslogar
     */
    public function logoutAction()
    {
        session_destroy();
        header('Location: /login');
	    exit;
    }
}