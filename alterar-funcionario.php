<?php
  session_start();
  ob_start();
  include_once 'util/helper.php';

  if(isset($_GET['id'])){
   include 'dao/funcionariodao.php';
   include 'controle/funcionario.php';

   $funcionarioDAO = new FuncionarioDAO();
   $array = $funcionarioDAO->filtrarFuncionario($_GET['id'],"codigof");
   //var_dump($array);
   $funcionario = $array[0];
   //echo $funcionario;
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
        <h1><a href="index.php">Alterar Funcionario</a></h1>
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
              <input type="text" name="txtnomef" placeholder="Digite Seu Nome" class="form-control"  title="EX : Apenas Letras" value="<?php if(isset($funcionario)){ echo $funcionario->nome;}?>"><!--pattern="^[A-zÁ-ü ]{1,50}$"-->
            </div>
            <div class="form-group">
              <input type="text" name="txtidadef" placeholder="Digite Sua Idade" class="form-control"  title="EX : Apenas Letras" value="<?php if(isset($funcionario)){ echo $funcionario->idade;}?>"><!--pattern="^[A-zÁ-ü ]{1,50}$"-->
            </div>
            <div class="form-group">
              <select name="selsexof" class="form-control">
                <option value="masculino" <?php if(isset($funcionario)){
                                                  if($funcionario->sexo == "masculino" ){
                                                    echo "selected ='selected'";
                                                  }
                                                }
                                          ?>>Masculino</option>
                <option value="feminino" <?php
                                            if(isset($funcionario)){
                                              if($funcionario->sexo == "feminino"){
                                                echo "selected = 'selected'";
                                              }
                                            }?>>Feminino</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="txtrgf" placeholder="Digite Seu RG" class="form-control"  title="Apenas Números EX : X.XXX" value="<?php if(isset($funcionario)){ echo $funcionario->rg; }?>"><!--pattern="^[0-9.]{1,10}$"-->
            </div>
            <div class="form-group">
              <input type="text" name="txtcpff" placeholder="Digite CPF" class="form-control"  title="Apenas Números EX : X.XX" value="<?php if(isset($funcionario)){ echo $funcionario->cpf; }?>"><!--pattern="^[0-9.]{1,10}$"-->
            </div>
            <div class="form-group">
              <input type="text" name="txtcnpjf" placeholder="Digite Sua Idade" class="form-control"  title="Apenas Números EX : NN" value="<?php if(isset($funcionario)){ echo $funcionario->cnpj; }?>"><!--pattern="^[0-9]{1,3}$"-->
            </div>
            <div class="form-group">
              <input type="submit" name="alterar" value="Alterar" class="btn btn-success">
              <input type="reset" name="Limpar" value="Limpar" class="btn btn-warning">
            </div>
          </form>
        </section>
        <?php
          if(isset($_POST['alterar'])){
            include_once 'controle/funcionario.php';
            include_once 'dao/funcionariodao.php';
            include_once 'util/helper.php';
            include 'util/padronizacao.php';

            $funcionario = new Funcionario();

            $funcionario->idFuncionario = $_GET['id'];
            $funcionario->nome = padronizacao::antiXSS(Padronizacao::nomePadronizacao($_POST['txtnomef']));
            $funcionario->sexo = Padronizacao::antiXSS($_POST['selsexof']);
            $funcionario->idade = Padronizacao::antiXSS($_POST['txtidadef']);
            $funcionario->rg = Padronizacao::antiXSS($_POST['txtrgf']);
            $funcionario->cpf = Padronizacao::antiXSS($_POST['txtcpff']);
            $funcionario->cnpj = Padronizacao::antiXSS($_POST['txtcnpjf']);

            //echo $cliente;
            $funcionarioDAO = new FuncionarioDAO();
            $funcionarioDAO->alterarFuncionario($funcionario);

            $_SESSION['msg'] = "Funcionario Alterado";
            header("location:consulta-funcionario.php");

            ob_end_flush();
          }
        ?>
      </div>
    </div>
  </body>
</html>
