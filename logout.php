<?php

$_SESSION = array();

if(isset($_SESSION)){
    session_unset();
    session_destroy();
}

?>