<?php

session_start();

require_once ("conexao.php");

if (!$_conexao) {
    die("Não foi possível conectar: " . mysqli_connect_error());
}
echo "Conexão bem sucedida";

if(isset($_POST["enviar"])){
  $_nome = $_POST["nome"];
  $_sobrenome = $_POST["sobrenome"];
  $_datai = $_POST["data_nasc"];
  $_data = strtotime($_datai);
  $_dataf = date('d-m-Y', $_data);
  $_signo = $_POST["signo"];
  $_genero = $_POST["genero"];
  $_login = $_POST["login"];
  $_senha = $_POST["senha"];
}

$_stmt = $_conexao->prepare("SELECT login FROM dados_cadastrados WHERE login = ?");
$_stmt->bind_param("s", $_login);

if ($_stmt->execute()) {
  $_res = $_stmt->get_result();
  $_selectRows = $_res->num_rows;

  if($_selectRows > 0){
    echo "<script>alert('Usuário já existente!');window.location.href='cadastro.html'</script>";
  }else{
    $_stmt = $_conexao->prepare("INSERT INTO dados_cadastrados(nome, sobrenome, data_nascimento, signo, genero, login, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $_stmt->bind_param("sssssss", $_nome, $_sobrenome, $_dataf, $_signo, $_genero, $_login, $_senha);

    if($_stmt->execute()){
      echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='inicio.php'</script>";
      include_once("direcionar.php");
    }else{
      echo "<scrip>alert('Ops! Não foi possível cadastrar seu usuário :( ');window.location.href='cadastro.html'</script>";
    }
  }
}else{
  echo "Error: " . mysqli_error($_conexao);
}

$_stmt->close();
$_conexao->close();

?>