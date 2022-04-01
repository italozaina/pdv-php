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
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('teste/{id:\d+}', ['controller' => 'Home', 'action' => 'umUsuario']);
$router->add('nova', ['controller' => 'Home', 'action' => 'nova']);

// $router->add('{controller}/{action}');

// die(var_dump($router->getRoutes()));

// $router->dispatch($_SERVER['QUERY_STRING']);
$router->dispatch($_SERVER['REQUEST_URI']);