<?php
  class Professor{

    private $idProfessor;
    private $nomeCompleto;
    private $sexo;
    private $idade;
    private $cpf;
    private $dataContrato;
    private $mes;
    private $ano;

    public function construct(){}

    public function destruct(){}

    public function __set($variavel,$tipo){
      $this->$variavel = $tipo;
    }

    public function __get($variavel){
      return $this->$variavel;
    }

    public function __toString(){
      return nl2br("Código : $this->idProfessor
                    Nome : $this->nomeCompleto
                    Sexo : $this->sexo
                    Idade : $this->idade
                    CPF : $this->cpf
                    Data do Contrato : $this->dataContrato
                    mes : $this->mes
                    ano : $this->ano");
    }
  }
