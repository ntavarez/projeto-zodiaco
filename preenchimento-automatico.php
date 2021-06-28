<?php
    include_once("conexao.php");

    function retorno($_data, $_pdo){
        $_stmt = $_pdo->prepare("SELECT signo, id from signos WHERE DAYOFMONTH(:data_nasc) >= DAYOFMONTH(data_inicio) 
                                AND MONTH(:data_nasc) = MONTH(data_inicio) OR DAYOFMONTH(:data_nasc) <=
                                DAYOFMONTH(data_final) AND MONTH(:data_nasc) = MONTH(data_final)");
        $_stmt->bindParam(":data_nasc", $_data);

        if ($_stmt->execute()) {
            $_rows = $_stmt->fetch(PDO::FETCH_ASSOC);
      
            if (count($_rows) > 0) {
                $_dados = implode (',', $_rows);
                list($_signo, $_signo_id) = explode(",", $_dados);

                $_valores['signo'] = $_signo;
                $_valores['signo_id'] = $_signo_id;
            } else {
                $_valores['signo'] = 'signo não encontrado';
                $_valores['signo_id'] = 'id não encontrado';
            }
        } else {
            echo "Não foi possível executar a query!";
        }

        $_stmt = null;
        
        return json_encode($_valores, JSON_UNESCAPED_UNICODE);
    }

    if(isset($_GET['data_nasc'])){
        echo retorno($_GET['data_nasc'], $_pdo);
    }
    
?>