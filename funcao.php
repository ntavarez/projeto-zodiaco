<?php

    if(isset($_GET['data_nasc'])){
        $_datai = $_GET['data_nasc'];
        $_datas = strtotime($_datai);
        $_dataf = date('d-m-Y', $_datas);
        $_date = explode('-', $_dataf);

        $_dia = $_date[0];
        $_mes = $_date[1];

        if($_dia >= 21 && $_mes == 3 || $_dia < 21 && $_mes == 4){
            $_valores['signo'] = "Áries";
        } 
        else if($_dia >= 21 && $_mes == 4 || $_dia < 21 && $_mes == 5) {
            $_valores['signo'] = "Touro";
        }
        else if($_dia >= 21 && $_mes == 5 || $_dia < 21 && $_mes == 6) {
            $_valores['signo'] = "Gêmeos";
        }
        else if($_dia >= 21 && $_mes == 6 || $_dia < 22 && $_mes == 7) {
            $_valores['signo'] = "Câncer";
        }
        else if($_dia >= 22 && $_mes == 7 || $_dia < 23 && $_mes == 8) {
            $_valores['signo'] = "Leão";
        }
        else if($_dia >= 23 && $_mes == 8 || $_dia < 23 && $_mes == 9) {
            $_valores['signo'] = "Virgem";
        }
        else if($_dia >= 23 && $_mes == 9 || $_dia < 23 && $_mes == 10) {
            $_valores['signo'] = "Libra";
        }
        else if($_dia >= 23 && $_mes == 10 || $_dia < 22 && $_mes == 11) {
            $_valores['signo'] = "Escorpião";
        }
        else if($_dia >= 22 && $_mes == 11 || $_dia < 22 && $_mes == 12) {
            $_valores['signo'] = "Sagitário";
        } 
        else if($_dia >= 22 && $_mes == 12 || $_dia < 21 && $_mes == 1) {
            $_valores['signo'] = "Capricórnio";
        }
        else if($_dia >= 21 && $_mes == 1 || $_dia < 20 && $_mes == 2) {
            $_valores['signo'] = "Aquário";
        }else{
            $_valores['signo'] = "Peixes";
        }
        echo json_encode($_valores);
    }
    
?>