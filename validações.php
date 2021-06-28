<?php

include_once("conexao.php");

function getSigno($_signoId, $_pdo){
    $_stmt = $_pdo->prepare("SELECT signo FROM signos WHERE id = :signo_id");
    $_stmt->bindParam(":signo_id", $_signoId);
    
    if ($_stmt->execute()) {
        $_rows = $_stmt->fetch(PDO::FETCH_ASSOC);

        if($_rows && count($_rows) > 0){
            $_signoRow = implode($_rows);
            $_SESSION['signo'] = $_signoRow;

            return $_SESSION['signo'];
        }
        else{
            echo "<script>alert('Signo não encontrado!')</script>";
        }
    }
    else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }

    $_stmt = null;
}

function getDefinicaoSigno($_signo, $_pdo){
    return include_once("./txt/signos/{$_SESSION['signo']}/Definicao-{$_SESSION['signo']}.txt");
}

function getElemento($_signo, $_pdo){
    $_stmt = $_pdo->prepare("SELECT elemento FROM signos WHERE signo = :signo");
    $_stmt->bindParam(":signo", $_signo);

    if($_stmt->execute()){
        $_rows = $_stmt->fetch(PDO::FETCH_ASSOC);

        if($_rows && count($_rows) > 0){
            $_elementoRow = implode($_rows);
            $_elemento = $_elementoRow;

            return include_once("./txt/elementos/{$_elemento}-elemento.txt");
        }
        else{
            echo "<script>alert('Elemento não encontrado!')</script>";
        }
    }else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }

    $_stmt = null;
}

function getModalidade($_signo, $_pdo){
    $_stmt = $_pdo->prepare("SELECT modalidade FROM signos WHERE signo = :signo");
    $_stmt->bindParam(":signo", $_signo);

    if($_stmt->execute()){
        $_rows = $_stmt->fetch(PDO::FETCH_ASSOC);

        if($_rows && count($_rows) > 0){
            $_modalidadeRow = implode($_rows);
            $_modalidade = $_modalidadeRow;

            return include_once("./txt/modalidade/mod-{$_modalidade}.txt");
        }
        else{
            echo "<script>alert('Modalidade não encontrada!')</script>";
        }
    }else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }

    $_stmt = null;
}

function getDefinicaoPlaneta($_signo, $_pdo){
    return include_once("./txt/planetas/{$_SESSION['planeta']}.txt");
}

function getPlaneta($_signo, $_pdo){
    $_stmt = $_pdo->prepare("SELECT planeta FROM signos WHERE signo = :signo");
    $_stmt->bindParam(":signo", $_signo);

    if($_stmt->execute()){
        $_rows = $_stmt->fetch(PDO::FETCH_ASSOC);

        if($_rows && count($_rows) > 0){
            $_planetaRow = implode($_rows);
            $_SESSION['planeta'] = $_planetaRow;

            $_SESSION['planeta-img'] = "./img/planetas/{$_SESSION['planeta']}.jpg";

            return $_SESSION['planeta'];
        }
        else{
            echo "<script>alert('Planeta não encontrado!')</script>";
        }
    }else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }

    $_stmt = null;
}

function getCompatibilidade($_signo, $_pdo){

    //getElemento($_signo, $_pdo);
    $_stmt = $_pdo->prepare("SELECT elemento FROM signos WHERE signo = :signo");
    $_stmt->bindParam(":signo", $_signo);

    if($_stmt->execute()){
        $_rows = $_stmt->fetch(PDO::FETCH_ASSOC);

        if($_rows && count($_rows) > 0){
            $_elementoRow = implode($_rows);
            $_elemento = $_elementoRow;

            return include_once("./txt/compatibilidade/compat-{$_elemento}.txt");
        }
        else{
            echo "<script>alert('Elemento não encontrado!')</script>";
        }
    
    }else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }

    $_stmt = null;
}

?>