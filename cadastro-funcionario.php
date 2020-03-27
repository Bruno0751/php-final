<?php
  session_start();
  ob_start();
  include_once 'util/helper.php';
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
    <div class="center container-fluid ">
      <header class="jumbotron container-fluid head">
        <h1><a href="index.php">Cadastro de Funcionario</a></h1>
      </header>
        <nav class="navbar container-fluid menu">
            <ul class="nav navbar-nav ">
              <li><a href="cadastro-professor.php">Cadastro de Professor</a></li>
              <li><a href="cadastro-cliente.php">Cadastro de Clientes</a></li>
              <li><a href="consulta-funcionario.php">Consulta de Funcionarios</a></li>
              <li><a href="consulta-professor.php">Consulta de Professoress</a></li>
              <li><a href="consulta-cliente.php">Consulta de Clientes</a></li>
            </ul>
        </nav>
        <?php
          echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
          unset($_SESSION['msg']);
        ?>
        <section class="container-fluid">
          <form name="cadprofessor" method="post" action="">
            <div class="form-group">
              <input type="text" name="txtnome" placeholder="Digite o Nome do Funcionario" class="form-control" required title="EX : Apenas Letras">
            </div>
            <div class="form-group">
              <input type="text" name="txtidadef" placeholder="Digite a Idade do Funcionario" class="form-control" required title="Apenas Números EX : XX">
            </div>
            <div class="form-group">
              <select name="selsexof" class="form-control">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="txtrgf" placeholder="Digite o RG do Funcionario" class="form-control" required title="EX : Apenas Números">
            </div>
            <div class="form-group">
              <input type="text" name="txtcpff" placeholder="Digite o CPF do Funcionario" class="form-control" required title="EX : Apenas Números">
            </div>
            <div class="form-group">
              <input type="text" name="txtcnpjf" placeholder="digite o CNPJ do Funcionario" class="form-control" title="EX : Apenas Números">
            </div>
            <div class="form-group">
              <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
              <input type="reset" name="Limpar" value="Limpar" class="btn btn-warning">
            </div>
          </form>
        </section>
        <?php
          //falta código
          if(isset($_POST['cadastrar'])){
            include 'controle/funcionario.php';
            include 'dao/funcionariodao.php';
            include 'util/padronizacao.php';

            $funcionario = new Funcionario();
            $funcionario->nome = Padronizacao::antiXSS(Padronizacao::nomePadronizacao($_POST['txtnome']));
            $funcionario->idade = Padronizacao::antiXSS($_POST['txtidadef']);
            $funcionario->sexo = Padronizacao::antiXSS($_POST['selsexof']);
            $funcionario->rg = Padronizacao::antiXSS($_POST['txtrgf']);
            $funcionario->cpf = Padronizacao::antiXSS($_POST['txtcpff']);
            $funcionario->cnpj = Padronizacao::antiXSS($_POST['txtcnpjf']);

            $funcionarioDAO = new FuncionarioDAO();
            $funcionarioDAO->cadastrarFuncionario($funcionario);

            $_SESSION['msg'] = "Funcionario Cadastrado Com Sucesso!";
            header("location:cadastro-funcionario.php");
            ob_end_flush();
          }
        ?>
      </div>
    </div>
  </body>
</html>
