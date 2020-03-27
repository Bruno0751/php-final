<?php
  require 'conexaobanco.class.php';
  class ProfessorDAO{

    private $conect = null;

    public function __construct(){
      $this->conect = ConexaoBanco::getInstance();
    }

    public function __destruct(){}

    public function cadastrarProfessor($professor){
      try{
        $stat = $this->conect->prepare("insert into professor(id_professor,nome,sexo,idade,cpf,data_contrato)values(null,?,?,?,?,?)");

        $stat->bindValue(1,$professor->nome);
        $stat->bindValue(2,$professor->sexo);
        $stat->bindValue(3,$professor->idade);
        $stat->bindValue(4,$professor->cpf);
        $stat->bindValue(5,$professor->dataContrato);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Cadastrar Professor".$erro;
      }
    }

    public function buscarProfessor(){
      try{
        $stat = $this->conect->query("select * from professor");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Professor');
        return $array;
      }catch(PDOException $erro){
        echo "Erro ao Buscar Professores".$erro;
      }
    }

    public function filtrarProfessor($pesquisa,$filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigop" : $query = "where id_professor = ".$pesquisa;
         break;
         case "nomep" : $query = "where nome like '%".$pesquisa."%'";
         break;
         case "sexop" : $query = "where sexo like '%".$pesquisa."%'";
         break;
         case "idadep" : $query = "where idade like '%".$pesquisa."%'";
         break;
         case "cpfp" : $query = "where cpf like '%".$pesquisa."%'";
         break;
         case "data_contratop" : $query = "where data_contrato like '%".$pesquisa."%'";
         break;

       }

       //echo "query: ".$query;
       $stat = $this->conect->query("select * from professor {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS,"Professor");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Professor ".$erro;
     }
   }

    public function alterarProfessor($professor){
     try{
       $stat = $this->conect->prepare("update professor set nome=?, sexo=?, idade=?, cpf=?, data_contrato=? where id_professor=?");

       $stat->bindValue(1,$professor->nome);
       $stat->bindValue(2,$professor->sexo);
       $stat->bindValue(3,$professor->idade);
       $stat->bindValue(4,$professor->cpf);
       $stat->bindValue(5,$professor->dataContrato);
       $stat->bindValue(6,$professor->idProfessor);

       $stat->execute();
     }catch(PDOException $erro){
       echo "Erro ao Alterar Professor".$erro;
     }
    }

    public function deletarProfessor($id){
      try{
        $stat = $this->conect->prepare("delete from professor where id_professor = ?");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Deleta Professor".$erro;
      }
    }
  }
