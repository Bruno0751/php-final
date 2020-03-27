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
          $stat = $this->conect->prepare("insert into funcionario(id_funcionario,nome,idade,sexo,rg,cpf,cnpj)values(null,?,?,?,?,?,?)");

          $stat->bindValue(1,$funcionario->nome);
          $stat->bindValue(2,$funcionario->idade);
          $stat->bindValue(3,$funcionario->sexo);
          $stat->bindValue(4,$funcionario->rg);
          $stat->bindValue(5,$funcionario->cpf);
          $stat->bindValue(6,$funcionario->cnpj);
          $stat->execute();
        }catch(PDOException $erro){
          echo "Erro ao Cadastrar Funcionario".$erro;
        }
      }

      public function buscarFuncionario(){
        try{
          $stat = $this->conect->query("select * from funcionario");
          $array = $stat->fetchAll(PDO::FETCH_CLASS,"Funcionario");
          return $array;
        }catch(PDOException $erro){
          echo "Erro ao Buscar Funcionarios".$erro;
        }
      }

      public function filtrarFuncionario($pesquisa,$filtro){
       try{
         $query = "";
         switch($filtro){
           case "todosf" : $query = "";
           break;
           case "codigof" : $query = "where id_funcionario = ".$pesquisa;
           break;
           case "nomef" : $query = "where nome like '%".$pesquisa."%'";
           break;
           case "idadef" : $query = "where idade like '%".$pesquisa."%'";
           break;
           case "sexof" : $query = "where sexo like '%".$pesquisa."%'";
           break;
           case "rgf" : $query = "where rg like '%".$pesquisa."%'";
           break;
           case "cpff" : $query = "where cpf like '%".$pesquisa."%'";
           break;
           case "cnpjf" : $query = "where cnpj like '%".$pesquisa."%'";
           break;
         }
         $stat = $this->conect->query("select * from funcionario {$query}");
         $array = $stat->fetchAll(PDO::FETCH_CLASS,"Funcionario");
         return $array;
       }catch(PDOException $erro){
         echo "Erro ao Filtrar Funcionario ".$erro;
       }
     }

     public function alterarFuncionario($funcionario){
      try{
        $stat = $this->conect->prepare("update funcionario set nome=?, idade=?, sexo=?, rg=?, cpf=?, cnpj=? where id_funcionario=?");

        $stat->bindValue(1,$funcionario->nome);
        $stat->bindValue(2,$funcionario->idade);
        $stat->bindValue(3,$funcionario->sexo);
        $stat->bindValue(4,$funcionario->rg);
        $stat->bindValue(5,$funcionario->cpf);
        $stat->bindValue(6,$funcionario->cnpj);
        $stat->bindValue(7,$funcionario->idFuncionario);

        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Alterar Funcionario ".$erro;
      }
     }

      public function deletarFuncionario($id){
        try{
          $stat = $this->conect->prepare("delete from funcionario where id_funcionario = ?");
          $stat->bindValue(1,$id);
          $stat->execute();
        }catch(PDOException $erro){
          echo "Erro ao Deleta Funcionarios".$erro;
        }
      }
  }
