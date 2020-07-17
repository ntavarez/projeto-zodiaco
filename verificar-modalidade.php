<?php

$_stmt = $_conexao->prepare("SELECT signo FROM dados_cadastrados WHERE login = ? AND senha = ?");
$_stmt->bind_param("ss", $_SESSION['login'], $_SESSION['senha']);

if($_stmt->execute()){
    $_res = $_stmt->get_result();
    $_rows_1 = $_res->fetch_assoc();

    $_stmt = $_conexao->prepare("SELECT modalidade FROM dados_signos WHERE signo = ?");
    $_stmt->bind_param("s", $_rows_1['signo']); 

    /*Verificar modalidade*/

    if($_stmt->execute()){
        $_res = $_stmt->get_result();
        $_rows = $_res->fetch_assoc();
    
        if($_rows['modalidade'] == 'Cardinal'){
            include_once("./txt/modalidade/mod-cardinal.txt");
        }else if($_rows['modalidade'] == 'Fixo'){
            include_once("./txt/modalidade/mod-fixo.txt");
        }else{
            include_once("./txt/modalidade/mod-mutavel.txt");
        }
    }else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }
}else{
    echo "<script>alert('Não foi possível executar a query!')</script>";
}

?>