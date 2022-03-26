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

// Adicionar as rotas
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('nova', ['controller' => 'Home', 'action' => 'nova']);
$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);