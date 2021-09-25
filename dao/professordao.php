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
        $stat = $this->conect->prepare("INSERT INTO bd_php_final.professores(id_professor, nome, sexo, idade, cpf, data_contrato)VALUES(NULL, ?, ?, ?, ?, ?);");

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
        $stat = $this->conect->query("SELECT * FROM bd_php_final.professores");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Professor');
        return $array;
      }catch(PDOException $erro){
        echo "Erro ao Buscar Professores".$erro;
      }
    }

    public function filtrarProfessor($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigop" : $query = "WHERE id_professor = ".$pesquisa;
         break;
         case "nomep" : $query = "WHERE nome LIKE '%".$pesquisa."%'";
         break;
         case "sexop" : $query = "WHERE sexo LIKE '%".$pesquisa."%'";
         break;
         case "idadep" : $query = "WHERE idade = ".$pesquisa;
         break;
         case "cpfp" : $query = "WHERE cpf LIKE '%".$pesquisa."%'";
         break;
         case "data_contratop" : $query = "WHERE data_contrato LIKE '%".$pesquisa."%'";
         break;

       }

       //echo "query: ".$query;
       $stat = $this->conect->query("SELECT * FROM bd_php_final.professores {$query};");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, "Professor");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Professor ".$erro;
     }
   }

    public function alterarProfessor($professor){
     try{
       $stat = $this->conect->prepare("UPDATE bd_php_final.professores SET nome = ?, sexo = ?, idade = ?, cpf = ?, data_contrato = ? WHERE id_professor = ?;");

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
        $stat = $this->conect->prepare("DELETE FROM bd_php_final.professores WHERE id_professor = ?;");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Deleta Professor".$erro;
      }
    }
  }
