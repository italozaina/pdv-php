<?php
/**
 * Controller inicial front
 * 
 */
// Carregar autoload (uso do gerenciador de pacotes composer)
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Tratamento de erros e exceções
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Controlador de rotas
 */
$router = new Core\Router();
// die(var_dump($_SERVER['REQUEST_URI']));
// Adicionar as rotas
$router->add('', ['controller' => 'PainelController', 'action' => 'index']);
$router->add('login', ['controller' => 'SecurityController', 'action' => 'login']);
$router->add('logout', ['controller' => 'SecurityController', 'action' => 'logout']);
$router->add('painel', ['controller' => 'PainelController', 'action' => 'index']);
$router->add('teste/{id:\d+}', ['controller' => 'UsuarioController', 'action' => 'umUsuario']);
$router->add('nova', ['controller' => 'UsuarioController', 'action' => 'nova']);
$router->add('usuarios', ['controller' => 'UsuarioController', 'action' => 'index']);

// $router->add('{controller}/{action}');


/**
 * Exemplo básico de login
 */
session_start();

if (!isset($_SESSION['usuarioLogado']) && !in_array($_SERVER['REQUEST_URI'], ['/login'])) {
    header('Location: /login');
    exit;
}

$router->dispatch($_SERVER['REQUEST_URI']);