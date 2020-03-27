<?php
  session_start();
  ob_start();
  include_once 'util/helper.php';

  if(isset($_GET['id'])){
   include 'dao/professordao.php';
   include 'controle/professor.php';

   $professorDAO = new ProfessorDAO();
   $array = $professorDAO->filtrarProfessor($_GET['id'],"codigop");
   var_dump($array);
   $professor = $array[0];
   echo $professor;
  }
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
        <h1><a href="index.php">Cadastro de Professor</a></h1>
      </header>
        <nav class="navbar container-fluid menu">
          <ul class="nav navbar-nav ">
            <li><a href="cadastro-cliente.php">Cadastro de Cliente</a></li>            
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
              <input type="text" name="txtnomep" placeholder="nome" class="form-control" value="<?php if(isset($professor)){ echo $professor->nome;}?>">
            </div>
            <div class="form-group">
              <select name="selsexop" class="form-control">
                <option value="Masculino" <?php if(isset($professor)){
                                                  if($professor->sexo == 'masculuno'){
                                                    echo "selected = 'selected'";
                                                  }
                                                }
                                          ?>
                >Masculino</option>
                <option value="Feminino" <?php if(isset($professor)){
                                                  if($professor->sexo == 'feminino'){
                                                    echo "selected = 'selected'";
                                                  }
                                                }
                ?>>Feminino</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="txtidadep" placeholder="IDADE" class="form-control" value="<?php if(isset($professor)){ echo $professor->idade;}?>">
            </div>
            <div class="form-group">
              <input type="text" name="txtcpfp" placeholder="CPF" class="form-control" value="<?php if(isset($professor)){ echo $professor->cpf;}?>">
            </div>
            <div class="form-group">
              <input type="text" name="txtdatacontratop" placeholder="DATA DO CONTRATO" class="form-control" value="<?php if(isset($professor)){ echo $professor->data_contrato;}?>">
            </div>
            <div class="form-group">
              <input type="submit" name="alterar" value="Alterar" class="btn btn-success">
              <input type="reset" name="Limpar" value="Limpar" class="btn btn-warning">
            </div>
          </form>
          <?php
              if(isset($_POST['alterar'])){
                include_once 'dao/professordao.php';
                include_once 'controle/professor.php';
                include_once 'util/padronizacao.php';
                include_once 'util/helper.php';

                $professor = new Professor();

                $professor->idProfessor = $_GET['id'];
                $professor->nome = Padronizacao::antiXSS(Padronizacao::nomePadronizacao($_POST['txtnomep']));
                $professor->sexo = Padronizacao::antiXSS($_POST['selsexop']);
                $professor->idade = Padronizacao::antiXSS($_POST['txtidadep']);
                $professor->cpf = Padronizacao::antiXSS($_POST['txtcpfp']);
                $professor->dataContrato = Padronizacao::antiXSS($_POST['txtdatacontratop']);

                $professorDAO = new ProfessorDAO();
                $professorDAO->alterarProfessor($professor);

                $_SESSION['msg'] = "Professor Alterado";
                header("location:consulta-professor.php");

                ob_end_flush();
              }

          ?>
        </section>
    </div>
  </body>
</html>
