<?php

$_stmt = $_conexao->prepare("SELECT elemento, modalidade FROM dados_signos WHERE signo = ?");
$_stmt->bind_param("s", $_SESSION['signo']);

/*Verificar definição do signo*/

if($_stmt->execute()){
    $_res = $_stmt->get_result();
    $_select_2 = $_res->fetch_assoc();

    if($_select_2['elemento'] == 'Fogo' && $_select_2['modalidade'] == 'Cardinal'){
        include_once("./txt/signos/aries/definicao-aries.txt");
    }else if($_select_2['elemento'] == 'Fogo' && $_select_2['modalidade'] == 'Fixo'){
        include_once("./txt/signos/leao/definicao-leao.txt");
    }else if($_select_2['elemento'] == 'Fogo' && $_select_2['modalidade'] == 'Mutável'){
        include_once("./txt/signos/sagitario/definicao-sagitario.txt");
    }else if($_select_2['elemento'] == 'Água' && $_select_2['modalidade'] == 'Cardinal'){
        include_once("./txt/signos/cancer/definicao-cancer.txt");
    }else if($_select_2['elemento'] == 'Água' && $_select_2['modalidade'] == 'Fixo'){
        include_once("./txt/signos/escorpiao/definicao-escorpiao.txt");
    }else if($_select_2['elemento'] == 'Água' && $_select_2['modalidade'] == 'Mutável'){
        include_once("./txt/signos/peixes/definicao-peixes.txt");
    }else if($_select_2['elemento'] == 'Terra' && $_select_2['modalidade'] == 'Cardinal'){
        include_once("./txt/signos/capricornio/definicao-capricornio.txt");
    }else if($_select_2['elemento'] == 'Terra' && $_select_2['modalidade'] == 'Fixo'){
        include_once("./txt/signos/touro/definicao-touro.txt");
    }else if($_select_2['elemento'] == 'Terra' && $_select_2['modalidade'] == 'Mutável'){
        include_once("./txt/signos/virgem/definicao-virgem.txt");
    }else if($_select_2['elemento'] == 'Ar' && $_select_2['modalidade'] == 'Cardinal'){
        include_once("./txt/signos/libra/definicao-libra.txt");
    }else if($_select_2['elemento'] == 'Ar' && $_select_2['modalidade'] == 'Fixo'){
        include_once("./txt/signos/aquario/definicao-aquario.txt");
    }else{
        include_once("./txt/signos/gemeos/definicao-gemeos.txt");
    }
}else{
    echo "<script>alert('Não foi possível executar a query!');window.location.href='login.php'</script>";
}

$_stmt->close();

?>