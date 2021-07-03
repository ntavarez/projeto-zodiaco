<?php

if(isset($_POST)){
    session_destroy();
    header('Location: login.php');
}

?>