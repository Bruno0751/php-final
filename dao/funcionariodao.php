<?php
  require 'conexaobanco.class.php';
  class FuncionarioDAO{

      private $conect = null;

      public function __construct(){
        $this->conect = ConexaoBanco::getInstance();
      }

      public function __destruct(){}

      public function cadastrarFuncionario($funcionario){
        try{
          $stat = $this->conect->prepare("INSERT INTO bd_php_final.funcionarios(id_funcionario, nome, idade, sexo, rg, cpf, cnpj)VALUES(NULL, ?, ?, ?, ?, ?, ?);");

          $stat->bindValue(1,$funcionario->nome);
          $stat->bindValue(2,$funcionario->idade);
          $stat->bindValue(3,$funcionario->sexo);
          $stat->bindValue(4,$funcionario->rg);
          $stat->bindValue(5,$funcionario->cpf);
          $stat->bindValue(6,$funcionario->cnpj);
          $stat->execute();
        }catch(PDOException $erro){
          echo "<script>window.alert('Erro ao Cadadtrar');</script>" .$erro;
        }
      }

      public function buscarFuncionario(){
        try{
          $stat = $this->conect->query("SELECT * FROM bd_php_final.funcionarios;");
          $array = $stat->fetchAll(PDO::FETCH_CLASS, "Funcionario");
          return $array;
        }catch(PDOException $erro){
          echo "<script>window.alert('Erro ao Buscar');</script>" .$erro;
        }
      }

      public function filtrarFuncionario($pesquisa, $filtro){
       try{
         $query = "";
         switch($filtro){
           case "todos" : $query = "";
           break;
           case "codigo" : $query = "WHERE id_funcionario = ".$pesquisa;
           break;
           case "nome" : $query = "WHERE nome LIKE '%".$pesquisa."%'";
           break;
           case "idade" : $query = "WHERE idade = ".$pesquisa;
           break;
           case "sexo" : $query = "WHERE sexo LIKE '%".$pesquisa."%'";
           break;
           case "rgf" : $query = "WHERE rg LIKE '%".$pesquisa."%'";
           break;
           case "cpf" : $query = "WHERE cpf LIKE '%".$pesquisa."%'";
           break;
           case "cnpj" : $query = "WHERE cnpj LIKE '%".$pesquisa."%'";
           break;
         }
         $stat = $this->conect->query("SELECT * FROM bd_php_final.funcionarios {$query};");
         $array = $stat->fetchAll(PDO::FETCH_CLASS, "Funcionario");
         return $array;
       }catch(PDOException $erro){
        echo "<script>window.alert('Erro ao Filtrar');</script>" .$erro;
       }
     }

     public function alterarFuncionario($funcionario){
      try{
        $stat = $this->conect->prepare("UPDATE bd_php_final.funcionarios SET nome = ?, idade = ?, sexo = ?, rg = ?, cpf = ?, cnpj = ? WHERE id_funcionario = ?;");

        $stat->bindValue(1,$funcionario->nome);
        $stat->bindValue(2,$funcionario->idade);
        $stat->bindValue(3,$funcionario->sexo);
        $stat->bindValue(4,$funcionario->rg);
        $stat->bindValue(5,$funcionario->cpf);
        $stat->bindValue(6,$funcionario->cnpj);
        $stat->bindValue(7,$funcionario->idFuncionario);

        $stat->execute();
      }catch(PDOException $erro){
        echo "<script>window.alert('Erro ao Alterar');</script>" .$erro;
      }
     }

      public function deletarFuncionario($id){
        try{
          $stat = $this->conect->prepare("DELETE FROM bd_php_final.funcionarios WHERE id_funcionario = ?;");
          $stat->bindValue(1,$id);
          $stat->execute();
        }catch(PDOException $erro){
          echo "<script>window.alert('Erro ao Deletar');</script>" .$erro;
        }
      }
  }
