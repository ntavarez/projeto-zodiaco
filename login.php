<?php

session_start();

require_once ("conexao.php");

if(isset($_POST["entrar"])){
  // Verificando se os campos foram preenchidos
  if(!isset($_POST["login"]) && !isset($_POST["senha"])){
    echo "<script>alert('Dados inválidos, favor preencher os campos!');window.location.href='login.html'</script>";
    die();
  }

  $_login = $_POST["login"];
  $_senha = $_POST["senha"];

  $_stmt = $_conexao->prepare("SELECT login FROM dados_cadastrados WHERE login = ? AND senha = ?");
  $_stmt->bind_param("ss", $_login, $_senha);
    
  if($_stmt->execute()){
    $_res = $_stmt->get_result();
    $_rows = $_res->num_rows;

    // Verifcando login existente no BD
    if($_rows > 0){
      echo "<script>alert('Logado com sucesso!');window.location.href='inicio.php'</script>";
      include_once("direcionar.php");
    }else{
      echo "<script>alert('Usuário não encontrado!');window.location.href='login.html'</script>";
    }
  }else{
     echo "<script>alert('Não foi possível executar a query!');window.location.href='login.html'</script>";
  }
}else{
  echo "<script>alert('Dados não encontrados! Favor preencher todos os campos.');window.location.href='login.html'</script>";
}

$_stmt->close();
$_conexao->close();

?>