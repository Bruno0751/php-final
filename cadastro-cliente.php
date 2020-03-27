<?php
  session_start();
  ob_start();
  include_once 'util/helper.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Um Site Para um Projeto Final de PHP Esta é Uma Página de Cadastro de Cliente</title>
    <meta http-equiv="Content-Type" content="text/php;charset=UTF-8">
    <meta name="author" content="Bruno Gressler da Silveira">
    <meta name="description" content="Um Site Feito Inteiramente e Exclusivamente Para Registros em Uma Academia, Onde Conterá Registros de Funcionários, Clientes e Também Professores, um Site Especializado em PHP e Também Banco de Dados Gratuito.">
    <meta name="keywords" content="Cadastro, Professor, Consulta, Funcionario, Cliente">
    <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">
    <link rel="icon" href="image/icone.png">

    <link  href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="vendor/components/jquery/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="style/estilos.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h2 style="display: none;">Consulta</h2>
    <div class="center container-fluid ">
      <header class="jumbotron container-fluid head">
        <h1><a href="index.php">Cadastro de Cliente</a></h1>
      </header>
        <nav class="navbar container-fluid menu">
            <ul class="nav navbar-nav ">
              <li><a href="cadastro-professor.php">Cadastro de Professor</a></li>
              <li><a href="cadastro-funcionario.php">Cadastro de Funcionario</a></li>
              <li><a href="consulta-professor.php">Consulta Professor</a></li>
              <li><a href="consulta-funcionario.php">Consulta Funcionario</a></li>
              <li><a href="consulta-cliente.php">Consulta Cliente</a></li>
            </ul>
        </nav>
        <?php
          echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
          unset($_SESSION['msg']);
        ?>
        <section class="container-fluid">
          <form name="cadcliente" method="post" action="">
            <div class="form-group">
              <input type="text" name="txtnomec" placeholder="Digite o Nome do Cliente" class="form-control" required title="EX : Apenas Letras"><!--pattern="^[A-zÁ-ü ]{1,50}$"-->
            </div>
            <div class="form-group">
              <select name="selsexoc" class="form-control">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="txtpesoc" placeholder="Digite o Peso do Cliente" class="form-control"  title="Apenas Números EX : X.XXX" required><!--pattern="^[0-9.]{1,10}$"-->
            </div>
            <div class="form-group">
              <input type="text" name="txtalturac" placeholder="Digite a Altura do Cliente" class="form-control"  title="Apenas Números EX : X.XX" required><!--pattern="^[0-9.]{1,10}$"-->
            </div>
            <div class="form-group">
              <input type="text" name="txtidadec" placeholder="Digite a Idade do Cliente" class="form-control"  title="Apenas Números EX : XX" required><!--pattern="^[0-9]{1,3}$"-->
            </div>
            <div class="form-group">
              <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
              <input type="reset" name="Limpar" value="Limpar" class="btn btn-warning">
            </div>
          </form>
        </section>
        <?php
          if(isset($_POST['cadastrar'])){
            include 'controle/cliente.php';
            include 'dao/clientedao.php';
            include 'util/padronizacao.php';

            $cliente = new Cliente();
            $cliente->nome = Padronizacao::antiXSS(Padronizacao::nomePadronizacao($_POST['txtnomec']));
            $cliente->sexo = Padronizacao::antiXSS($_POST['selsexoc']);
            $cliente->peso = Padronizacao::antiXSS($_POST['txtpesoc']);
            $cliente->altura = Padronizacao::antiXSS($_POST['txtalturac']); //n precisa é int
            $cliente->idade = Padronizacao::antiXSS($_POST['txtidadec']);

            $clienteDAO = new ClienteDAO();
            $clienteDAO->cadastrarCliente($cliente);

            $_SESSION['msg'] = "Cliente Cadastrado Com Sucesso!";
            header("location:cadastro-cliente.php");

            ob_end_flush();
          }
        ?>
      </div>
    </div>
  </body>
</html>
