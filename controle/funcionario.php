<?php
  class Funcionario{

    private $idFuncionario;
    private $nomeCompleto;
    private $idade;
    private $sexo;
    private $rg;
    private $cpf;
    private $cnpj;

    public function __construct(){}

    public function __destruct(){}

    public function __set($variavel,$tipo){
        $this->$variavel = $tipo;
    }

    public function __get($variavel){
      return $this->$variavel;
    }

    public function __toString(){
      return nl2br("Código : $this->idFuncionario
                    Nome : $this->nomeCompleto
                    Idade : $this->idade
                    Sexo: : $this->sexo
                    RG : $this->rg
                    CPF : $this->cpf
                    CNPJ : $this->cnpj");
    }
  }
