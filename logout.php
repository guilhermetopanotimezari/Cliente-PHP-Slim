<?php
    session_start();
    session_destroy();

    include('server/conexao.php');
    header('location: /'. $GLOBALS['site'] .'/');
?>