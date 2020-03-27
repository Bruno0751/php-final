<?php
  session_start();
  ob_start();

  include_once 'controle/funcionario.php';
  include_once 'dao/funcionariodao.php';
  include_once 'util/helper.php';

  $funcionarioDAO = new FuncionarioDAO();
  $array = $funcionarioDAO->buscarFuncionario();
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

    <link  href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="style/estilos.css">

    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h2 style="display: none;">Consulta</h2>
    <div class="center container-fluid">
      <header class="jumbotron container-fluid head">
        <h1><a href="index.php">Consulta de Funcionario</a></h1>
      </header>
      <nav class="navbar container-fluid menu">
        <ul class="nav navbar-nav ">
          <li><a href="cadastro-professor.php">Cadastro de Professor</a></li>
          <li><a href="cadastro-cliente.php">Cadastro de cliente</a></li>
          <li><a href="cadastro-funcionario.php">Cadastro de Funcionario</a></li>
          <li><a href="consulta-professor.php">Consulta de Professores</a></li>
          <li><a href="consulta-cliente.php">Consulta de clientes</a></li>
        </ul>
      </nav>
      <?php
        if(isset($_SESSION['msg'])){
          Helper::alert($_SESSION['msg']);
          unset($_SESSION['msg']);
        }
        if(count($array) == 0){
          echo "<h1>Não Há Funcionarios Cadastrados</h1>";
          return;
        }
      ?>
      <p style='text-align: center; font-size: 26px;'>Digite Sua Pesquisa</p>;
        <form name="filtro" method="POST" action="">
          <div class="row">
            <div class="col-md-6 form-group">
              <input name="txtfiltrof" type="text" placeholder="Digite o Que Deseja!" class="form-control">
            </div>
            <div class="col-md-6 ">
              <select name="selfiltrarf" class="form-control">
                <option value="todosf">Todos</option>
                <option value="codigof">Código</option>
                <option value="nomef">Nome</option>
                <option value="idadef">Idade</option>
                <option value="sexof">Sexo</option>
                <option value="rgf">RG</option>
                <option value="cpff">CPF</option>
                <option value="cnpjf">CNPJ</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" name="filtrarf" value="Procurar" class="btn btn-primary btn-block">
          </div>
        </form>
        <?php
          if(isset($_POST['filtrarf'])){
            $pesquisa = $_POST['txtfiltrof'];
            $filtro = $_POST['selfiltrarf'];

            if(!empty($pesquisa)){
              $funcionarioDAO = new FuncionarioDAO();
              $array = $funcionarioDAO->filtrarFuncionario($pesquisa,$filtro);

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
                <th>Idade</th>
                <th>Sexo</th>
                <th>RG</th>
                <th>CPF</th>
                <th>CNPJ</th>
                <th>Excluir</th>
                <th>Alterar</th>
              </tr>
            <thead>
            <tfoot>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>RG</th>
                <th>CPF</th>
                <th>CNPJ</th>
                <th>Excluir</th>
                <th>Alterar</th>
              <tr>
          </tfoot>
          <tbody>
            <?php
              foreach($array as $linhas){
                echo "<tr>";
                  echo "<td>$linhas->id_funcionario</td>";
                  echo "<td>$linhas->nome</td>";
                  echo "<td>$linhas->idade</td>";
                  echo "<td>$linhas->sexo</td>";
                  echo "<td>$linhas->rg</td>";
                  echo "<td>$linhas->cpf</td>";
                  echo "<td>$linhas->cnpj</td>";
                  echo "<td><a class='btn btn-danger' href='consulta-funcionario.php?id=$linhas->id_funcionario'>Excluir</a></td>";
                  echo "<td><a class='btn btn-success' href='alterar-funcionario.php?id=$linhas->id_funcionario'>Alterar</a></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
        <?php
          if(isset($_GET['id'])){
            $funcionarioDAO->deletarFuncionario($_GET['id']);
              $_SESSION['msg'] = "Funcionario Excluido";
              //erro ob_end_star();
              header("location:consulta-funcionario.php");
              ob_end_flush();
          }
        ?>
      </div><!--fecha div table responsive container-->
    </div><!--fecha div container-fluid-->
  </body>
</html>
