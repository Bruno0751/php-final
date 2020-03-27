<?php
  session_start();
  ob_start();
  include_once 'util/helper.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style/estilos.css">
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <h2 style="display: none;">Consulta</h2>
  <div class="center container-fluid ">
    <header class="jumbotron container-fluid head">
      <h1><a href="index.php">Cadastro de Usuários</a></h1>
    </header>    
    <nav class="navbar container-fluid menu">
        <ul class="nav navbar-nav">
          <li class="nav-item active"><a class="nav-link" href="index.php">Login</a></li>
          <?php
            if(isset($_SESSION['privateUser'])){
          ?>
              <li class="nav-item active"><a class="nav-link" href="cadastro-cliente.php">Cadastro de Cliente</a></li>
              <li class="nav-item active"><a class="nav-link" href="cadasto-livro.php">Cad.livro</a></li>
              <li class="nav-item active"><a class="nav-link" href="cadastro-usuario.php">Cad.User</a></li>
              <li class="nav-item active"><a class="nav-link" href="index.php">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="consulta-livros.php">Cons. Livros</a></li>
          <?php
            }
          ?>
        </ul>
    </nav>
    <?php
      echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
      unset($_SESSION['msg']);
    ?>
      <section class="container-fluid">
          <form name="caduser" method="post" action="">
            <div class="form-group">
              <input type="text" name="txtnomeu" placeholder="Digite o Nome do Usuário" class="form-control" required title="EX : Apenas Letras">
            </div>
            <div class="form-group">
              <input type="text" name="txtloginu" placeholder="Digite o Seu Login" class="form-control"  title="Apenas Números EX : X.XXX" required>
            </div>
            <div class="form-group">
              <input type="text" name="txtsenhau" placeholder="Digite a Sua Senha" class="form-control"  title="Apenas Números EX : X.XX" required>
            </div>
            <div class="form-group">
              <select name="seltipou" class="form-control">
                <option value="adm">ADM</option>
                <option value="visitante">Visitante</option>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
              <input type="reset" name="Limpar" value="Limpar" class="btn btn-warning">
            </div>
          </form>
          <?php
            if(isset($_POST['cadastrar'])){
              include 'dao/usuariodao.php';
              include 'controle/usuario.php';

              $user = new Usuario();
              $user->nome = $_POST['txtnomeu'];
              $user->login = $_POST['txtloginu'];
              $user->senha = $_POST['txtsenhau'];
              $user->tipo = $_POST['seltipou'];

              $usDAO = new UsuarioDAO();
              $usDAO->cadastrarUsuario($user);

              $_SESSION['msg'] = "Usuario Cadastrado";
              header('location:cadastro-user.php');
              ob_end_flush();
            }
          ?>
      </section>
    </div>
  </body>
</html>
