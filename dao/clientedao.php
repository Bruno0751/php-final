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
        $stat = $this->conect->prepare("insert into cliente(id_cliente,nome,sexo,peso,altura,idade)values(null,?,?,?,?,?)");
        $stat->bindValue(1,$cliente->nome);
        $stat->bindValue(2,$cliente->sexo);
        $stat->bindValue(3,$cliente->peso);
        $stat->bindValue(4,$cliente->altura);
        $stat->bindValue(5,$cliente->idade);

        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Cadastrar Cliente ".$erro;
      }
    }

    public function buscarCliente(){
      try{
        $stat = $this->conect->query("select * from cliente");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Cliente');
        return $array;
      }catch(PDOException $erro){
        echo "Erro ao Buscar Clientes".$erro;
      }
    }

    public function filtrarCliente($pesquisa,$filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigo" : $query = "where id_cliente = ".$pesquisa;
         break;
         case "nome" : $query = "where nome like '%".$pesquisa."%'";
         break;
         case "sexo" : $query = "where sexo like '%".$pesquisa."%'";
         break;
         case "peso" : $query = "where peso like '%".$pesquisa."%'";
         break;
         case "altura" : $query = "where altura like '%".$pesquisa."%'";
         break;
         case "idade" : $query = "where idade like '%".$pesquisa."%'";
         break;
       }

       //echo "query: ".$query;
       $stat = $this->conect->query("select * from cliente {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS,"Cliente");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Cliente ".$erro;
     }
   }

    public function alterarCliente($cliente){
     try{
       $stat = $this->conect->prepare("update cliente set nome=?, sexo=?, peso=?, altura=?, idade=? where id_cliente=?");

       $stat->bindValue(1,$cliente->nome);
       $stat->bindValue(2,$cliente->sexo);
       $stat->bindValue(3,$cliente->peso);
       $stat->bindValue(4,$cliente->altura);
       $stat->bindValue(5,$cliente->idade);
       $stat->bindValue(6,$cliente->idCliente);

       $stat->execute();
     }catch(PDOException $erro){
       echo "Erro ao Alterar Cliente ".$erro;
     }
    }

    public function deletarCliente($id){
      try{
        $stat = $this->conect->prepare("delete from cliente where id_cliente = ?");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Deleta Cliente ".$erro;
      }
    }
  }
