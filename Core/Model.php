<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base do model (modelo/entidade)
 * 
 */
abstract class Model
{
    /**
     * Retorna a conexão PDO com o banco
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            // $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            // $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            $db = new PDO('sqlite:'.dirname(__DIR__).'/Banco/banco.db');

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}