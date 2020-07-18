<?php
  include_once("conexao.php");
?>
<!DOCTYPE html>
<!-- doctype informa ao agente de usuario a versão do html que deve ser renderizada-->

<html lang="pt-br">
<head>
    <title>~Cantinho dos Signos~</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="https://github.com/ntavarez">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilo.css">
    <script type="text/javascript" src="jquery-3.5.1.js"></script>
    <script type="text/javascript" src="validando-senha.js"></script>
</head>
<body>
    <!-- Cadastro POST -->
  <div class="cadastro">
    <form class="formulario" id="form2" method="post">
      <p>Dados para cadastro</p>
        
      <div class="campo">
          <label for="nome">nome:</label>
          <input type="text" id="nome" name="nome" data-ls-module="charCounter" maxlength="25" placeholder="digite seu nome*" required>
      </div>

      <div class="campo">
          <label for="sobrenome">sobrenome:</label>
          <input type="text" id="sobrenome" name="sobrenome" data-ls-module="charCounter" maxlength="60" placeholder="digite seu sobrenome*" required>
      </div>

      <div class="campo">
          <label for="data">data de nascimento:</label>
          <input type="date" name="data_nasc" required>
      </div>

      <div class="campo">
          <label for="signo">signo:</label>
          <input type="text" name="signo" data-ls-module="charCounter" maxlength="15">
      </div>

      <div class="campo-radiobox">
          <label for="genero">gênero:<br></label>
          <input type="radio" name="genero" value="feminino">Feminino <br>
          <input type="radio" name="genero" value="masculino">Masculino <br>
          <input type="radio" name="genero" value="indefinido">Indefinido<br>
      </div>

      <div class="campo">
          <label for="login">login:</label>
          <input type="text" name="login" data-ls-module="charCounter" maxlength="20" placeholder="escolha seu login*" required>
      </div>

      <div class="campo">
          <label for="senha">senha:</label>
          <input type="password" name="senha" data-ls-module="charCounter" maxlength="25" placeholder="digite sua senha*" required>
      </div>

      <input type="submit" name="enviar" value="Enviar">
      <a class="btn" href="login.php">Voltar</a>

    </form>
  </div>  

  <script type=text/javascript>
    $(document).ready(function(){
      $("input[name='data_nasc']").blur(function(){
        var $_signo = $("input[name='signo']");
        $.getJSON('funcao.php', {
          data_nasc: $ (this).val()
        }, function(json){
          $_signo.val(json.signo);
        });
      });
    });
  </script>

  <?php

  session_start();

  if(isset($_POST["enviar"])){
    if(!isset($_POST["nome"]) && !isset($_POST["sobrenome"]) && !isset($_POST["data_nasc"]) && !isset($_POST["data_nasc"])
    && !isset($_POST["signo"]) && !isset($_POST["genero"]) && !isset($_POST["login"]) && !isset($_POST["senha"])){
      echo "<script>alert('Dados inválidos, favor preencher os campos!');window.location.href='login.php'</script>";
      die();
    }
    $_SESSION['nome'] = $_POST["nome"];
    $_sobrenome = $_POST["sobrenome"];
    $_datai = $_POST["data_nasc"];
    $_data = strtotime($_datai);
    $_dataf = date('d-m-Y', $_data);
    $_SESSION['signo'] = $_POST["signo"];
    $_genero = $_POST["genero"];
    $_SESSION['login'] = $_POST["login"];
    $_SESSION['senha'] = $_POST["senha"];
  }

  $_stmt = $_conexao->prepare("SELECT login FROM dados_cadastrados WHERE login = ?");
  $_stmt->bind_param("s", $_SESSION['login']);

  if ($_stmt->execute()) {
    $_res = $_stmt->get_result();
    $_selectRows = $_res->num_rows;

    if($_selectRows > 0){
      echo "<script>alert('Usuário já existente!');window.location.href='cadastro.html'</script>";
    }else{
      $_stmt = $_conexao->prepare("INSERT INTO dados_cadastrados(nome, sobrenome, data_nascimento, signo, genero, login, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $_stmt->bind_param("sssssss", $_SESSION['nome'], $_sobrenome, $_dataf, $_SESSION['signo'], $_genero, $_SESSION['login'], $_SESSION['senha']);

      if($_stmt->execute()){
        echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='inicio.php'</script>";
        include_once("direcionar.php");
      }else{
        echo "<scrip>alert('Não foi possível cadastrar seu usuário!');window.location.href='cadastro.php'</script>";
      }
    }
  }else{
    echo "Error: " . mysqli_error($_conexao);
  }

  $_stmt->close();

  ?>
</body>

<footer><p>Por <a href="https://github.com/ntavarez">Natália Tavares</a></p></footer>

<?php
  $_conexao->close();
?>
</html>