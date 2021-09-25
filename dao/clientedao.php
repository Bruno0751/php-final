<?php
  require 'conexaobanco.class.php';
  class ClienteDAO{

    private $conect = null;

    public function __construct(){
      $this->conect = ConexaoBanco::getInstance();
    }

    public function __destruct(){}

    public function cadastrarCliente($cliente){
      try{
        $stat = $this->conect->prepare("INNSERT INTO bd_php_final.clientes(id_cliente,nome,sexo,peso,altura,idade)VALUES(NULL, ?, ?, ?, ?, ?);");
        $stat->bindValue(1,$cliente->nome);
        $stat->bindValue(2,$cliente->sexo);
        $stat->bindValue(3,$cliente->peso);
        $stat->bindValue(4,$cliente->altura);
        $stat->bindValue(5,$cliente->idade);

        $stat->execute();
      }catch(PDOException $erro){
        echo "<script>window.alert('Erro ao Cadastrar');</script>" .$erro;
      }
    }

    public function buscarCliente(){
      try{
        $stat = $this->conect->query("SELECT * FROM bd_php_final.clientes;");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Cliente');
        return $array;
      }catch(PDOException $erro){
        echo "<script>window.alert('Erro ao Buscar');</script>" .$erro;
      }
    }

    public function filtrarCliente($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigo" : $query = "WHERE id_cliente = ".$pesquisa;
         break;
         case "nome" : $query = "WHERE nome LIKE '%".$pesquisa."%'";
         break;
         case "sexo" : $query = "WHERE sexo LIKE '%".$pesquisa."%'";
         break;
         case "peso" : $query = "WHERE peso = ".$pesquisa;
         break;
         case "altura" : $query = "WHERE altura = ".$pesquisa;
         break;
         case "idade" : $query = "WHERE idade = ".$pesquisa;
         break;
       }

       //echo "query: ".$query;
       $stat = $this->conect->query("SELECT * FROM bd_php_final.clientes {$query};");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, "Cliente");
       return $array;
     }catch(PDOException $erro){
      echo "<script>window.alert('Erro ao Filtar');</script>" .$erro;
     }
   }

    public function alterarCliente($cliente){
     try{
       $stat = $this->conect->prepare("UPDATE bd_php_final.clientes SET nome = ?, sexo = ?, peso = ?, altura = ?, idade = ? WHERE id_cliente = ?;");

       $stat->bindValue(1,$cliente->nome);
       $stat->bindValue(2,$cliente->sexo);
       $stat->bindValue(3,$cliente->peso);
       $stat->bindValue(4,$cliente->altura);
       $stat->bindValue(5,$cliente->idade);
       $stat->bindValue(6,$cliente->idCliente);

       $stat->execute();
     }catch(PDOException $erro){
      echo "<script>window.alert('Erro ao Alterar');</script>" .$erro;
     }
    }

    public function deletarCliente($id){
      try{
        $stat = $this->conect->prepare("DELETE FROM bd_php_final.clientes WHERE id_cliente = ?;");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "<script>window.alert('Erro ao Deletar');</script>" .$erro;
      }
    }
  }
