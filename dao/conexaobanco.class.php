<?php
  class ConexaoBanco extends PDO{

    private static $inst = null;

    public function __construct($bd,$user,$pass){
      parent::__construct($bd,$user,$pass);
    }

    public static function getInstance(){
      try{
        if(!isset(self::$inst)){
          self::$inst = new ConexaoBanco("mysql:dbname=bdphp;host=localhost","root","");
        }
        return self::$inst;
      }catch(PDOException $erro){
        echo "Erro ao Conectar Com o Banco ".$erro;
      }
    }
  }
