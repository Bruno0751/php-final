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
        <h1><a href="index.php">Cadastro de Professor</a></h1>
      </header>
        <nav class="navbar container-fluid menu">
            <ul class="nav navbar-nav ">
              <li><a href="index.php">Cadastro de Cliente</a></li>
              <li><a href="cadastro-funcionario.php">Cadastro de Funcionario</a></li>
              <li><a href="consulta-cliente.php">Consultas de Clientes</a></li>
              <li><a href="consulta-funcionario.php">Consultas de Funcionarios</a></li>
              <li><a href="consulta-professor.php">Consultas de Professores</a></li>
            </ul>
        </nav>
        <?php
          echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
          unset($_SESSION['msg']);
        ?>
        <section class="container-fluid">
          <form name="cadprofessor" method="POST" action="">
            <div class="form-group">
              <input type="text" name="txtnomep" placeholder="Digite o Nome do Professor" class="form-control" title="EX : Apenas Letras">
            </div>
            <div class="form-group">
              <select name="selsexop" class="form-control">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="txtidadep" placeholder="Digite Sua Idade do Professor" class="form-control" title="Apenas Números EX : XX">
            </div>
            <div class="form-group">
              <input type="text" name="txtcpfp" placeholder="Digite Seu CPF do Professor" class="form-control"  title="EX : Apenas Números">
            </div>
            <div class="form-group">
              <input type="text" name="txtdiap" placeholder="Dia do Contarato do Professor" class="form-control" title="Apenas Números EX : XX">
            </div>
            <div class="form-group">
              <input type="text" name="txtmesp" placeholder="Mês do Contrato do Professor" class="form-control"  title="Apenas Números EX : XX">
            </div>
            <div class="form-group">
              <input type="text" name="txtanop" placeholder="Ano do Contrato do Professor" class="form-control"  title="Apenas Números EX : XXXX">
            </div>
            <div class="form-group">
              <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
              <input type="reset" name="Limpar" value="Limpar" class="btn btn-warning">
            </div>
          </form>
        </section>
        <?php
          if(isset($_POST['cadastrar'])){
            include 'controle/professor.php';
            include 'dao/professordao.php';
            include 'util/padronizacao.php';

            $professor = new Professor();

            $professor->nome = Padronizacao::antiXSS(Padronizacao::nomePadronizacao($_POST['txtnomep']));
            $professor->sexo = Padronizacao::antiXSS($_POST['selsexop']);
            $professor->idade = Padronizacao::antiXSS($_POST['txtidadep']);
            $professor->cpf = Padronizacao::antiXSS($_POST['txtcpfp']);
            $professor->dataContrato = Padronizacao::antiXSS(Padronizacao::juntarDatas($_POST['txtdiap'],$_POST['txtmesp'],$_POST['txtanop']));

            $professorDAO = new ProfessorDAO();
            $professorDAO->cadastrarProfessor($professor);

            $_SESSION['msg'] = "Professor Cadastrado Com Sucesso!";
            header("location:cadastro-professor.php");
            ob_end_flush();
          }
        ?>
      </div>
    </div>
  </body>
</html>
