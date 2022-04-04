<?php

namespace App\Model;

class Type
{
    private $key;
    private $opt;

    public function __construct(string $key, array $opt = []){
        $this->key = $key;
        $this->opt = $opt;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey(string $key)
    {
        $this->key = $key;
        return $this;
    }

    public function getOpt()
    {
        return $this->opt;
    }

    public function setOpt(string $opt)
    {
        $this->opt = $opt;
        return $this;
    }    
}
