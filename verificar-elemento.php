<?php

$_stmt = $_conexao->prepare("SELECT elemento FROM dados_signos WHERE signo = ?");
$_stmt->bind_param("s", $_SESSION['signo']); 
    
/*Verificar elemento*/

if($_stmt->execute()){
    $_res = $_stmt->get_result();
    $_rows = $_res->fetch_assoc();

    if($_rows['elemento'] == 'Fogo'){
        include_once("./txt/elementos/fogo-elemento.txt");
    }else if ($_rows['elemento'] == 'Terra'){
        include_once("./txt/elementos/terra-elemento.txt");
    }else if ($_rows['elemento'] == 'Água'){
        include_once("./txt/elementos/agua-elemento.txt");
    }else{
        include_once("./txt/elementos/ar-elemento.txt");
    }
}else{
    echo "<script>alert('Não foi possível executar a query!')</script>";
}

$_stmt->close();

?>