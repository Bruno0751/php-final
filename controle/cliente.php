<?php
  class Cliente{

    private $idCliente;
    private $nomeCompleto;
    private $sexo;
    private $peso;
    private $altura;
    private $idade;

    public function __construct(){}

    public function __destruct(){}

    public function __set($variavel,$tipo){
      $this->$variavel = $tipo;
    }

    public function __get($variavel){
      return $this->$variavel;
    }

    public function __toString(){
      return nl2br("Código : $this->idCliente
                  Nome : $this->nomeCompleto
                  Sexo : $this->sexo
                  Idade : $this->idade
                  Peso : $this->peso
                  Altura : $this->altura");
      }
  }
