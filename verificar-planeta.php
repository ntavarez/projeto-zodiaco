<?php

if($_SESSION['signo'] == 'Áries' || $_SESSION['signo'] == 'Escorpião'){
    $_SESSION['planeta'] = "./img/planetas/marte.jpg";
    include_once("./txt/planetas/marte.txt");
}else if ($_SESSION['signo'] == 'Peixes' || $_SESSION['signo'] == 'Sagitário'){
    $_SESSION['planeta'] = "./img/planetas/jupiter.jpg";
    include_once("./txt/planetas/jupiter.txt");
}else if ($_SESSION['signo'] == 'Touro' || $_SESSION['signo'] == 'Libra'){
    $_SESSION['planeta'] = "./img/planetas/venus.jpg";
    include_once("./txt/planetas/venus.txt");
}else if($_SESSION['signo'] == 'Gêmeos' || $_SESSION['signo'] == 'Virgem'){
    $_SESSION['planeta'] = "./img/planetas/mercurio.jpg";
    include_once("./txt/planetas/mercurio.txt");
}else if($_SESSION['signo'] == 'Câncer'){
    $_SESSION['planeta'] = "./img/planetas/lua.jpg";
    include_once("./txt/planetas/lua.txt");
}else if($_SESSION['signo'] == 'Leão'){
    $_SESSION['planeta'] = "./img/planetas/sol.jpg";
    include_once("./txt/planetas/sol.txt");    
}else{
    $_SESSION['planeta'] = "./img/planetas/saturno.jpg";
    include_once("./txt/planetas/saturno.txt");
}

$_stmt->close();

?>