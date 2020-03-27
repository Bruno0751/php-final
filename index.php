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
        <h1 >Verificar</h1>
      </header>
      <h2 style="display: none;">Consulta</h2>
      <nav class="navbar container-fluid menu">
        <ul class="nav navbar-nav ">
          <li class="nav-item active"><a class="nav-link" href="cadastro-user.php">Cadastrar user</a></li>
          <?php
            if(isset($_SESSION['privateUser'])){
          ?>
              <li class="nav-item active"><a class="nav-link" href="cadastro-cliente.php">Cadastro de Cliente</a></li>
              <li class="nav-item active"><a class="nav-link" href="cadastro-funcionario.php">Cadastro de Funcionario</a></li>
              <li class="nav-item active"><a class="nav-link" href="consulta-cliente.php">Consultas de Clientes</a></li>
              <li class="nav-item active"><a class="nav-link" href="consulta-funcionario.php">Consultas de Funcionarios</a></li>
              <li class="nav-item active"><a class="nav-link" href="consulta-professor.php">Consultas de Professores</a></li>
          <?php
            }
          ?>
        </ul>
      </nav>
      <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
      ?>
      <?php
        if(!isset($_SESSION['privateUser'])){
      ?>
          <section class="container-fluid">
            <form name="login" method="post" action="">
              <div class="form-group">
                <input type="text" name="txtlogin" placeholder="Login" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" name="txtsenha" placeholder="Digite sua senha" class="form-control">
              </div>
              <div class="form-group">
                <select name="seltipo" class="form-control">
                  <option value="adm">Adm</option>
                  <option value="visitante">Visitante</option>
                </select>
              </div>
              <div class="form-group">
                <input type="submit" name="entrar" value="Entrar" class="btn btn-primary">
              </div>
            </form>
          </section>
      <?php
        }else{
          include_once "controle/usuario.php";
          $u = unserialize($_SESSION['privateUser']);
          echo "<h2>Olá {$u->nome}, seja bem vindo!</h2>";
      ?>
      <form name="deslogar" method="post" action="">
        <div class="form-group">
          <input type="submit" name="deslogar" value="Sair" class="btn btn-primary">
        </div>
      </form>
      <?php
          if(isset($_POST['deslogar'])){
            unset($_SESSION['privateUser']);
            header("location:index.php");
          }
      ?>
      <?php
        }
      ?>
      <?php
        if(isset($_POST['entrar'])){
          include 'controle/usuario.php';
          include 'dao/usuariodao.php';
          //include 'util/seguranca.class.php';

          $u = new Usuario();

          $u->login = $_POST['txtlogin'];
          $u->senha = $_POST['txtsenha'];
          $u->tipo = $_POST['seltipo'];

          $uDAO = new UsuarioDAO();
          $usuario = $uDAO->verificarUsuario($u);

          if($usuario == null){
            echo "<h2>Usuário/senha/tipo inválido(s)!</h2>";
          }else{
            $_SESSION['privateUser'] = serialize($usuario);
            header("location:index.php");
            echo "logado";
          }
        }
      ?>
    </div>
  </body>
</html>
