<?php
  session_start();
  ob_start();
  include '../util/validacao.php';
  include '../controle/professor.php';
  include '../dao/professordao.php';
  include '../util/padronizacao.php';

  $professor = new Professor();

  $professor->nome = Padronizacao::antiXSS(Padronizacao::nomePadronizacao($_POST['txtnomep']));
  $professor->sexo = Padronizacao::antiXSS($_POST['selsexop']);
  $professor->idade = Padronizacao::antiXSS($_POST['txtidadep']);
  $professor->cpf = Padronizacao::antiXSS($_POST['txtcpfp']);
  $professor->dataContrato = Padronizacao::antiXSS(Padronizacao::juntarDatas($_POST['txtdiap'],$_POST['txtmesp'],$_POST['txtanop']));

  $professorDAO = new ProfessorDAO();
  $professorDAO->cadastrarProfessor($professor);

  header("location:../cadastro-professor.php");
  ob_end_flush();
