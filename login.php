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

    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Cabin:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <!-- Login POST -->
    <p id="welcome">~ Cantinho dos Signos ~</p>

    <div class="flex-container">
      <div class="row justify-content-center align-self-center">
        <div class="d-flex-md-4">
          <form id="form1" method="post">
            <div class="form-group">
              <p>Bem-vindo(a)</p>             
              <div class="campo">
                <label for="login">login:</label>
                <input type="text" id="login" name="login" data-ls-module="charCounter" maxlength="20" required>
              </div>

              <div class="campo">
                <label for="login">senha:</label>
                <input type="password" id="senha" name="senha" data-ls-module="charCounter" maxlength="25" required>
              </div>

              <input type="submit" name="entrar" value="Entrar">
              <a class="btn" href="cadastro.php">Criar conta</a> 
            </div>           
          </form>
        </div>
      </div>
    </div>
    <?php
      session_start();
     
      if(isset($_POST["entrar"])){
        // Verificando se os campos foram preenchidos
        if(!isset($_POST["login"]) && !isset($_POST["senha"])){
          echo "<script>alert('Dados inválidos, favor preencher os campos!');window.location.href='login.php'</script>";
          die();
        }
            
        $_SESSION['login'] = $_POST["login"];
        $_SESSION['senha'] = $_POST["senha"];
            
        $_stmt = $_conexao->prepare("SELECT login FROM dados_cadastrados WHERE login = ? AND senha = ?");
        $_stmt->bind_param("ss", $_SESSION['login'], $_SESSION['senha']);
                
        if($_stmt->execute()){
          $_res = $_stmt->get_result();
          $_rows = $_res->num_rows;
            
            // Verifcando login existente no BD
            if($_rows > 0){
              echo "<script>alert('Logado com sucesso!');window.location.href='inicio.php'</script>";
              include_once("direcionar.php");
            }else{
              echo "<script>alert('Usuário não encontrado!');window.location.href='login.php'</script>";
              session_destroy();
            }
        }else{
          echo "Error: " . mysqli_error($_conexao);
        }
        $_stmt->close();
      }
      $_conexao->close();
    ?>
  <footer class="rodape"><p>Por <a href="https://github.com/ntavarez">Natália Tavares</a></p></footer>
</body>
</html>