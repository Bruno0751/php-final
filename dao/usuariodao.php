<?php
require 'conexaobanco.class.php';
 class UsuarioDAO { //DATA ACCESS OBJECT

   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarUsuario($user){
     try{
       $stat = $this->conexao->prepare("INSERT INTO bd_php_final.usuarios(id_user, nome, login, senha, tipo)VALUES(NULL, ?, ?, ?, ?);");
       $stat->bindValue(1,$user->nome);
       $stat->bindValue(2,$user->login);
       $stat->bindValue(3,$user->senha);
       $stat->bindValue(4,$user->tipo);

       $stat->execute();
     }catch(PDOException $erro){
       echo "Erro ao Cadastrar Usuario ".$erro;
     }
   }

   public function verificarUsuario($u){
     try{
       $stat = $this->conexao->prepare("SELECT * FROM bd_php_final.usuarios WHERE login = ? and senha = ? and tipo = ?;");

       $stat->bindValue(1, $u->login);
       $stat->bindValue(2, $u->senha);
       $stat->bindValue(3, $u->tipo);
       //echo $u;
       $stat->execute();

       $usuario = null;
       $usuario = $stat->fetchObject('Usuario');
       return $usuario;
     }catch(PDOException $e){
       echo "Erro ao buscar usuarios! ".$e;
     }
   }//fecha buscarLivros
 }//fecha classe
