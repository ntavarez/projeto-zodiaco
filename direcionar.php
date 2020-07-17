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
            $_SESSION['texto'] = "./txt/signos/cancer/definicao-cancer.txt";
            $_SESSION['img'] = "./img/constelacao-cancer.jpg";
            $_SESSION['simbolo'] = "./img/cancer-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/agua-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-cardinal.txt";
            $_SESSION['comp'] = "./txt/signos/cancer/compat-cancer.txt";
        }
        else if($_rows["signo"] == "Leão") {
            $_SESSION['texto'] = "./txt/signos/leao/definicao-leao.txt";
            $_SESSION['img'] = "./img/bg/constelacao-leao.jpg";
            $_SESSION['simbolo'] = "./img/icones/leao-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/fogo-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-fixo.txt";
            $_SESSION['comp'] = "./txt/signos/leao/compat-leao.txt";
        }
        else if($_rows["signo"] == "Virgem") {
            $_SESSION['texto'] = "./txt/signos/virgem/definicao-virgem.txt";
            $_SESSION['img'] = "./img/bg/constelacao-virgem.jpg";
            $_SESSION['simbolo'] = "./img/icones/virgem-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/terra-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-mutavel.txt";
            $_SESSION['comp'] = "./txt/signos/virgem/compat-aries.txt";
        }
        else if($_rows["signo"] == "Libra") {
            $_SESSION['texto'] = "./txt/signos/libra/definicao-libra.txt";
            $_SESSION['img'] = "./img/bg/constelacao-libra.jpg";
            $_SESSION['simbolo'] = "./img/icones/libra-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/ar-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-cardinal.txt";
            $_SESSION['comp'] = "./txt/signos/libra/compat-libra.txt";
        }
        else if($_rows["signo"] == "Escorpião") {
            $_SESSION['texto'] = "./txt/signos/escorpiao/definicao-escorpiao.txt";
            $_SESSION['img'] = "./img/bg/constelacao-escorpiao.jpg";
            $_SESSION['simbolo'] = "./img/icones/escorpiao-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/agua-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-fixo.txt";
            $_SESSION['comp'] = "./txt/signos/escorpiao/compat-escorpiao.txt";
        }
        else if($_rows["signo"] == "Sagitário") {
            $_SESSION['texto'] = "./txt/signos/sagitario/definicao-sagitario.txt";
            $_SESSION['img'] = "./img/bg/constelacao-sagitario.jpg";
            $_SESSION['simbolo'] = "./img/icones/sagitario-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/fogo-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-mutavel.txt";
            $_SESSION['comp'] = "./txt/signos/sagitario/compat-sagitario.txt";
        } 
        else if($_rows["signo"] == "Capricórnio") {
            $_SESSION['img'] = "./img/bg/constelacao-capricornio.jpg";
            $_SESSION['simbolo'] = "./img/icones/capricornio-simbolo.png";
            include_once("verificar-signo.php");
            include_once("verificar-elemento.php");
            include_once("verificar-modalidade.php");
            include_once("verificar-compatibilidade");
        }
        else if($_rows["signo"] == "Aquário") {
            $_SESSION['texto'] = "./txt/signos/aquario/definicao-aquario.txt";
            $_SESSION['img'] = "./img/bg/constelacao-aquario.jpg";
            $_SESSION['simbolo'] = "./img/icones/aquario-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/ar-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-fixo.txt";
            $_SESSION['comp'] = "./txt/signos/aquario/compat-aquario.txt";
        }else{
            $_SESSION['texto'] = "./txt/signos/peixes/definicao-peixes.txt";
            $_SESSION['img'] = "./img/bg/constelacao-peixes.jpg";
            $_SESSION['simbolo'] = "./img/icones/peixes-simbolo.png";
            $_SESSION['elemento'] = "./txt/elementos/agua-elemento.txt";
            $_SESSION['mod'] = "./txt/modalidade/mod-mutavel.txt";
            $_SESSION['comp'] = "./txt/signos/peixes/compat-peixes.txt";
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