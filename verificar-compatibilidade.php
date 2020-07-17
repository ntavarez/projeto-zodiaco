<?php
    
$_stmt = $_conexao->prepare("SELECT signo FROM dados_cadastrados WHERE login = ? AND senha = ?");
$_stmt->bind_param("ss", $_SESSION['login'], $_SESSION['senha']);

if($_stmt->execute()){
    $_res = $_stmt->get_result();
    $_rows_1 = $_res->fetch_assoc();

    $_stmt = $_conexao->prepare("SELECT elemento FROM dados_signos WHERE signo = ?");
    $_stmt->bind_param("s", $_rows_1['signo']); 
    
    /*Verificar compatibilidade*/
    
    if($_stmt->execute()){
        $_res = $_stmt->get_result();
        $_rows_2 = $_res->fetch_assoc();

        if($_rows_2['elemento'] == 'Fogo'){
            include_once("./txt/compatibilidade/compat-fogo.txt");
        }else if ($_rows_2['elemento'] == 'Terra'){
            include_once("./txt/compatibilidade/compat-terra.txt");
        }else if ($_rows_2['elemento'] == 'Água'){
            include_once("./txt/compatibilidade/compat-agua.txt");
        }else{
            include_once("./txt/compatibilidade/compat-ar.txt");
        }
    }else{
        echo "<script>alert('Não foi possível executar a query!')</script>";
    }
}else{
    echo "<script>alert('Não foi possível executar a query!')</script>";
}

$_stmt->close();

?>