<?php

namespace App\Model;

use PDO;

/**
 * Exemplo de um model(entidade) de Usuário
 */

 class Usuario extends \Core\Model 
 {

    private $id;
    private $nome;
    private $sobrenome;
    private $login;
    private $senha;
    private $acesso;
    private $ativo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSobrenome(): ?string
    {
        return $this->sobrenome;
    }

    public function setSobrenome(string $sobrenome): self
    {
        $this->sobrenome = $sobrenome;
        
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        
        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;
        
        return $this;
    }

    public function getAcesso(): ?int
    {
        return $this->acesso;
    }

    public function setAcesso(int $acesso): self
    {
        $this->acesso = $acesso;

        return $this;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getNomeCompleto(): ?string
    {
        return $this->nome.' '.$this->sobrenome;
    }

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM usuario');
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt->fetchAll(PDO::FETCH_CLASS,'\App\Model\Usuario');
    }

    public function criarTabela()
    {
        $db = static::getDB();
        $db->exec("CREATE TABLE IF NOT EXISTS usuario (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            sobrenome TEXT NOT NULL,
            login TEXT NOT NULL UNIQUE,  
            senha TEXT NOT NULL,
            acesso INTEGER,
            ativo INTEGER
          );");
    }

    public function dadosIniciais()
    {
        $db = static::getDB();

        $data = [
            ['nome'=>'Ítalo', 'sobrenome'=>'Zaina', 'login'=>'admin', 'senha'=>md5('123456'), 'acesso'=>1, 'ativo'=>1],
            ['nome'=>'Ginger', 'sobrenome'=>'Canadense', 'login'=>'cao', 'senha'=>md5('manga'), 'acesso'=>3, 'ativo'=>1]
        ];

        $insert = "INSERT INTO usuario (nome, sobrenome, login, senha, acesso, ativo)
        VALUES (:nome,:sobrenome,:login,:senha,:acesso,:ativo)";

        $stmt = $db->prepare($insert);

        foreach($data as $row) {
            $stmt->bindParam(':nome', $row['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':sobrenome', $row['sobrenome'], PDO::PARAM_STR);
            $stmt->bindParam(':login', $row['login'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $row['senha'], PDO::PARAM_STR);
            $stmt->bindParam(':acesso', $row['acesso'], PDO::PARAM_INT);
            $stmt->bindParam(':ativo', $row['ativo'], PDO::PARAM_INT);

            $stmt->execute();
        }

        return true;
    }    
 }