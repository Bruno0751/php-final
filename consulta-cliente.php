<?php
  session_start();
  ob_start();

  include_once 'controle/cliente.php';
  include_once 'dao/clientedao.php';
  include_once 'util/helper.php';

  $clienteDAO = new ClienteDAO();
  $array = $clienteDAO->buscarCliente();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Um Site Para um Projeto Final de PHP Esta é Uma Página de Cadastro de Cliente</title>
    <meta http-equiv="Contewnt-Type" content="text/php;charset=UTF-8">
    <meta name="author" content="Bruno Gressler da Silveira">
    <meta name="description" content="Um Site Feito Inteiramente e Exclusivamente Para Registros em Uma Academia, Onde Conterá Registros de Funcionários, Clientes e Também Professores, um Site Especializado em PHP e Também Banco de Dados Gratuito.">
    <meta name="keywords" content="Cadastro, Cliente, Consulta, Excluir, Buscar">
    <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">
    <link rel="icon" href="image/icone.png">

    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/estilos.css">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h2 style="display: none;">Consulta</h2>
    <div class="center container-fluid">
      <header class="jumbotron container-fluid head">
        <h1><a href="index.php">Consulta de Cliente</a></h1>
      </header>

      <nav class="navbar container-fluid menu">
          <ul class="nav navbar-nav ">
            <li><a href="cadastro-professor.php">Cadastro de Professor</a></li>
            <li><a href="cadastro-funcionario.php">Cadastro de Funcionario</a></li>
            <li><a href="cadastro-cliente.php">Cadastro de Cliente</a></li>
            <li><a href="consulta-funcionario.php">Consulta de Funcionarios</a></li>
            <li><a href="consulta-professor.php">Consulta de Professores</a></li>
          </ul>
      </nav>
      <?php
        if(isset($_SESSION['msg'])){
          Helper::alert($_SESSION['msg']);
          unset($_SESSION['msg']);
        }
        if(count($array) == 0){
          echo "<h1>Não Há Clientes Cadastrados</h1>";
          return;
        }
      ?>
      <p style='text-align: center; font-size: 26px;'>Digite Sua Pesquisa</p>;
      <form name="filtro" method="POST" action="">
        <div class="row">
          <div class="col-md-6 form-group">
            <input name="txtfiltro" type="text" placeholder="Digite o Que Deseja!" class="form-control">
          </div>
          <div class="col-md-6 ">
            <select name="selfilter" class="form-control">
              <option value="todos">Todos</option>
              <option value="codigo">Código</option>
              <option value="nome">nome</option>
              <option value="sexo">Sexo</option>
              <option value="peso">Peso</option>
              <option value="altura">Altura</option>
              <option value="idade">Idade</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="filtrar" value="Procurar" class="btn btn-primary btn-block">
        </div>
      </form>
      <?php
        if(isset($_POST['filtrar'])){
          $pesquisa = $_POST['txtfiltro'];
          $filtro = $_POST['selfilter'];

          if(!empty($pesquisa)){
            $clienteDAO = new ClienteDAO();
            $array = $clienteDAO->filtrarCliente($pesquisa, $filtro);
            if(count($array) == 0){
              echo "<h2 style='color: #FF4500; text-align: center; font-size: 30px;'>Pesquisa Não Encontrada</h2>
              <br>
              <p style='color: green; text-align: center; font-size: 30px;'>Tente Novamente</h2>";
              return;
            }
          }
        }
      ?>
      <div class="table-responsive container">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Sexo</th>
              <th>Peso</th>
              <th>Altura</th>
              <th>Idade</th>
              <th>Excluir</th>
              <th>Alterar</th>
            </tr>
          <thead>
          <tfoot>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Sexo</th>
              <th>Peso</th>
              <th>Altura</th>
              <th>Idade</th>
              <th>Excluir</th>
              <th>Alterar</th>
            <tr>
          </tfoot>
          <tbody>
            <?php
              foreach($array as $linhas){
                echo "<tr>";
                  echo "<td>$linhas->id_cliente</td>";
                  echo "<td>$linhas->nome</td>";
                  echo "<td>$linhas->sexo</td>";
                  echo "<td>$linhas->peso</td>";
                  echo "<td>$linhas->altura</td>";
                  echo "<td>$linhas->idade</td>";
                  echo "<td><a class='btn btn-danger' href='consulta-cliente.php?id=$linhas->id_cliente'>Excluir</a></td>";
                  echo "<td><a class='btn btn-success' href='alterar-cliente.php?id=$linhas->id_cliente'>Alterar</a></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
        <?php
          if(isset($_GET['id'])){
            $clienteDAO->deletarCliente($_GET['id']);
              $_SESSION['msg'] = "Cliente Excluido";
              header("location:consulta-cliente.php");
              ob_end_flush();
          }
        ?>
      </div>
    </div>
  </body>
</html>
