<?php
	session_start();

	include('../conexao.php');
	$conn = mysqli_connect($GLOBALS['localhost'], $GLOBALS['root'],"", $GLOBALS['dbname']);
	
	if(!empty($_POST["usuario"]) & !empty($_POST["senha"])) {
		$result = mysqli_query($conn,"SELECT * FROM usuario WHERE usuario='" . $_POST["usuario"] . "' and senha = '". $_POST["senha"]."'");
		
		$row  = mysqli_fetch_array($result);
		
		if(is_array($row)) {
			$_SESSION["usuario_id"] = $row['ID'];
			
			header('Location: ../../home');
		} else {
			header('Location: /'. $GLOBALS['site'] .'/?erro=2');
		}
	} else {
		header('Location: /'. $GLOBALS['site'] .'/?erro=1');
	}
?>
