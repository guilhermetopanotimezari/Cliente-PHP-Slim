<?php
    ini_set('default_charset', 'utf-8');

    $site = "portal";
    $localhost = "localhost";
    $dbname = "teste";
    $root = "root"; 

    function getConn(){
    	$pdo = new PDO('mysql:host='.$GLOBALS['localhost'].';dbname='.$GLOBALS['dbname'].';charset=utf8', $GLOBALS['root'],'', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$pdo->exec("SET CHARACTER SET utf8");
        return $pdo; 
    }
 ?>