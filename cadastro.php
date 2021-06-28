<?php
include_once("conexao.php");
?>
<!DOCTYPE html>
<!-- doctype informa ao agente de usuario a versão do html que deve ser renderizada-->

<html lang="pt-br">
<head>
  <title>~Cantinho dos Signos~</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
  <meta name="author" content="https://github.com/ntavarez">
  <meta name="keywords" content="astrologia, signos, misticismo">

  <script type="text/javascript" src="jquery-3.5.1.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script type="text/javascript" src="validando-senha.js"></script>

  <link rel="stylesheet" href="estilo.css">
</head>

<body>
  <!-- Cadastro POST -->
  <div class="flex-container">
    <div class="row justify-content-md-center">
      <div class="d-flex-md-4">
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

            <!--Campo oculto-->
            <div class="campo" id="signo-id">
              <input type="hidden" name="signo_id" data-ls-module="charCounter" maxlength="2">
            </div>

            <div class="campo">
              <label for="genero">gênero:<br></label>
              <div class="form-check">
                <input class="mr-2" type="radio" name="genero" value="feminino">Feminino <br>
                <input class="mr-2" type="radio" name="genero" value="masculino">Masculino <br>
                <input class="mr-2" type="radio" name="genero" value="indefinido">Indefinido<br>
              </div>
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
      </div>
    </div>
  </div>

  <!--Script de preenchimento de campo automático Signo e Signo_ID (oculto) de acordo com a data de nascimento-->

  <script type=text/javascript>
    $(document).ready(function() {
      $("input[name='data_nasc']").blur(function() {
        var $_signo = $("input[name='signo']");
        var $_signo_id = $("input[name='signo_id']");
        $.getJSON('preenchimento-automatico.php', {
          data_nasc: $(this).val()
        }, function(json) {
          $_signo.val(json.signo);
          $_signo_id.val(json.signo_id);
        });
      });
    });
  </script>

  <?php

  if (isset($_POST["nome"]) && isset($_POST["sobrenome"]) && isset($_POST["data_nasc"]) && isset($_POST["signo"]) 
  && isset($_POST["signo_id"]) && isset($_POST["genero"]) && isset($_POST["login"]) && isset($_POST["senha"])) {
    $_SESSION['nome'] = $_POST["nome"];
    $_sobrenome = $_POST["sobrenome"];
    $_data = $_POST["data_nasc"];
    $_SESSION['signo'] = $_POST["signo"];
    $_SESSION['signo_id'] = $_POST["signo_id"];
    $_genero = $_POST["genero"];
    $_SESSION['login'] = $_POST["login"];
    $_SESSION['senha'] = $_POST["senha"];

    $_stmt = $_pdo->prepare("SELECT login FROM usuarios WHERE :login");
    $_stmt->bindParam(":login", $_SESSION['login']);

    if ($_stmt->execute()) {
      $_rows_1 = $_stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($_rows_1) > 0) {
        echo "<script>alert('Usuário já existente!')</script>";
      }
      else 
      {
        $_stmt = $_pdo->prepare("INSERT INTO usuarios(nome, sobrenome, data_nasc, signo_id, genero, login, senha) 
                 VALUES (:nome, :sobrenome, :data_nasc, :signo_id, :genero, :login, :senha)");
        $_stmt->bindParam(":nome", $_SESSION['nome']);
        $_stmt->bindParam(":sobrenome", $_sobrenome);
        $_stmt->bindParam(":data_nasc", $_data);
        $_stmt->bindParam(":signo_id", $_SESSION['signo_id']);
        $_stmt->bindParam(":genero", $_genero);
        $_stmt->bindParam(":login", $_SESSION['login']);
        $_stmt->bindParam(":senha", $_SESSION['senha']);

        if ($_stmt->execute()) {
          $_rows_2 = $_stmt->fetch(PDO::FETCH_ASSOC);

          echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='inicio.php'</script>";
          include_once("direcionar.php");
        } 
        else {
            echo "Não foi possível cadastrar os dados!";
        }
      }
    } 
    else {
      echo "Erro ao montar query!";
    }
  }

  $_stmt = null;
  ?>

</body>
</html>