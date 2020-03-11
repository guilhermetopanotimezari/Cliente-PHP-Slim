<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='pt-br' xml:lang='pt-br' xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="Description" CONTENT="Portal">
		<meta http-equiv="Content-Type" content="php_value default_charset UTF-8" />	
		<META NAME="author" CONTENT="Guilherme Topanoti Mezari">
		<title>Portal</title>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	    <link href="assets/css/login.css" rel="stylesheet">
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="assets/imagens/icone-pontocom.ico" type="image/ico">
		
	</head>
  	<body>  
        <?php
            session_start();

            if(!isset($_SESSION["usuario_id"])){
        ?>
        <div id="login">
            <div class="form">
                <div class="logo-portal"></div>
                <h1>Seja bem-vindo(a) ao Portal</h1>
                <form action="server/usuario/valida.php" method="post">
                    <input type="usuario" name="usuario" id="usuario" placeholder="Usuário" />
                    <input type="senha" name="senha" id="senha" placeholder="Senha" autocomplete="off" />
                        <div class="error-div"><ul>
                            <?php
                                $erro = @$_GET['erro'];
                                $sucesso = @$_GET['sucesso'];
                                if ($erro == 1) {
                                    echo "<li>Usuário e/ou senha não informado</li>"; 
                                }
                                if ($erro == 2) {
                                    echo "<li>Usuário ou senha inválida</li>";
                                }
                            ?>   
                        </ul></div>
                    <input type="submit" id="login-btn" value="Entrar" />
                </form>
            </div>
        </div>

        <?php 
            }else{
                include('server/conexao.php');

                header('location: /'. $GLOBALS['site'] .'/home/');
            }
        ?>

		<script src="assets/js/jquery.js"></script>
        <script src="assets/js/main.js"></script>

  	</body>  
</html>	