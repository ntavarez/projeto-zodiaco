<?php

session_start();

include_once("conexao.php");

$_stmt = $_conexao->prepare("SELECT nome,signo FROM dados_cadastrados WHERE login = ? AND senha = ?");
$_stmt->bind_param("ss", $_SESSION['login'], $_SESSION['senha']);
    
if($_stmt->execute()){
    $_res = $_stmt->get_result();
    $_rows = $_res->fetch_assoc();

    if(isset($_rows["signo"])){
        header('Location: inicio.php');
        $_SESSION['signo'] = $_rows["signo"];
        $_SESSION['nome'] = $_rows["nome"];
        
        if($_SESSION['signo'] == "Áries"){
            $_SESSION['img'] = "./img/bg/constelacao-aries.jpg";
            $_SESSION['simbolo'] = "./img/icones/aries-simbolo.png";
        }       
        else if($_rows["signo"] == "Touro") {
            $_SESSION['img'] = "./img/bg/constelacao-touro.jpg";
            $_SESSION['simbolo'] = "./img/icones/touro-simbolo.png";
        }
        else if($_rows["signo"] == "Gêmeos") {
            $_SESSION['img'] = "./img/bg/constelacao-gemeos.jpg";
            $_SESSION['simbolo'] = "./img/icones/gemeos-simbolo.png";
        }
        else if($_rows["signo"] == "Câncer") {
            $_SESSION['img'] = "./img/constelacao-cancer.jpg";
            $_SESSION['simbolo'] = "./img/cancer-simbolo.png";
        }
        else if($_rows["signo"] == "Leão") {
            $_SESSION['img'] = "./img/bg/constelacao-leao.jpg";
            $_SESSION['simbolo'] = "./img/icones/leao-simbolo.png";
        }
        else if($_rows["signo"] == "Virgem") {
            $_SESSION['img'] = "./img/bg/constelacao-virgem.jpg";
            $_SESSION['simbolo'] = "./img/icones/virgem-simbolo.png";
        }
        else if($_rows["signo"] == "Libra") {
            $_SESSION['img'] = "./img/bg/constelacao-libra.jpg";
            $_SESSION['simbolo'] = "./img/icones/libra-simbolo.png";
        }
        else if($_rows["signo"] == "Escorpião") {
            $_SESSION['img'] = "./img/bg/constelacao-escorpiao.jpg";
            $_SESSION['simbolo'] = "./img/icones/escorpiao-simbolo.png";
        }
        else if($_rows["signo"] == "Sagitário") {
            $_SESSION['img'] = "./img/bg/constelacao-sagitario.jpg";
            $_SESSION['simbolo'] = "./img/icones/sagitario-simbolo.png";
        } 
        else if($_rows["signo"] == "Capricórnio") {
            $_SESSION['img'] = "./img/bg/constelacao-capricornio.jpg";
            $_SESSION['simbolo'] = "./img/icones/capricornio-simbolo.png";
        }
        else if($_rows["signo"] == "Aquário") {
            $_SESSION['img'] = "./img/bg/constelacao-aquario.jpg";
            $_SESSION['simbolo'] = "./img/icones/aquario-simbolo.png";
        }else{
            $_SESSION['img'] = "./img/bg/constelacao-peixes.jpg";
            $_SESSION['simbolo'] = "./img/icones/peixes-simbolo.png";
        }
    }else{
        echo "<script>alert('Signo não encontrado!')</script>";
    }
}else{
    echo "<script>alert('Não foi possível executar a query!')</script>";
}

$_stmt->close();
$_conexao->close();

?>