<?php

namespace App\Model;

use PDO;

/**
 * Exemplo de um model(entidade) de Usuário
 */

 class Usuario extends \Core\Model 
 {
    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 }