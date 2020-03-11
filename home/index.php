<?php
	session_start();

	if(!isset($_SESSION["usuario_id"]))
	{
	    header('location: /'. $GLOBALS['site'] .'/');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='pt-br' xml:lang='pt-br' xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="Description" CONTENT="Portal">
		<meta http-equiv="Content-Type" content="php_value default_charset UTF-8" />	
		<META NAME="author" CONTENT="Guilherme Topanoti Mezari">
		<title>Portal</title>

		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assets/css/main.css" rel="stylesheet">
		<link href="../assets/css/sb-admin.css" rel="stylesheet">
		<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="../assets/imagens/icone-portal.ico" type="image/ico">
		
	</head>
  	<body>  
  		<div id="wrapper">
	        <!-- Navigation -->
	        <?php include "../navbar.php" ?>

        	<div id="page-wrapper">

	            <div class="container-fluid">
	                <!-- Page Heading -->
	                <div class="row">
	                    <div class="col-lg-10">
	                        <h2 class="page-header" id='nomeVersaoHoje'>
	                            Hoje
	                        </h2>
	                    </div>
	                </div>
	               
	                <div class="row">
	                    <div class="col-lg-4 col-md-6">
	                        <div class="panel panel-green">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <i class="fa fa-link fa-5x"></i>
	                                    </div>
	                                    <div class="col-xs-9 text-right">
	                                        <div class="huge" id='quantSucessoHoje'>0</div>
	                                        <div>Atualizados com sucesso</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <a href="/<?php echo $GLOBALS['site']; ?>/clientes/?sucessoHoje=true">
	                                <div class="panel-footer">
	                                    <span class="pull-left">Ver detalhes</span>
	                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>
	                    <div class="col-lg-4 col-md-6">
	                        <div class="panel panel-red">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <i class="fa fa-users fa-5x"></i>
	                                    </div>
	                                    <div class="col-xs-9 text-right">
	                                        <div class="huge" id='quantErroHoje'>0</div>
	                                        <div>Atualizados com erro</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <a href="/<?php echo $GLOBALS['site']; ?>/clientes/?erroHoje=true" >
	                                <div class="panel-footer">
	                                    <span class="pull-left">Ver detalhes</span>
	                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>
	                    <div class="col-lg-4 col-md-6">
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <i class="fa fa-users fa-5x"></i>
	                                    </div>
	                                    <div class="col-xs-9 text-right">
	                                        <div class="huge" id='quantFaltaHoje'>0</div>
	                                        <div>Falta atualizar</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <a href="/<?php echo $GLOBALS['site']; ?>/clientes/?falta=true" >
	                                <div class="panel-footer">
	                                    <span class="pull-left">Ver detalhes</span>
	                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>
	                </div>
	                <!-- Page Heading -->
	                <div class="row">
	                    <div class="col-lg-12">
	                        <h2 class="page-header" id = 'nomeVersaoTotal'>
	                            Total
	                        </h2>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-lg-4 col-md-6">
	                        <div class="panel panel-green">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <i class="fa fa-link fa-5x"></i>
	                                    </div>
	                                    <div class="col-xs-9 text-right">
	                                        <div class="huge" id='quantSucesso'>0</div>
	                                        <div>Atualizados com sucesso</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <a href="/<?php echo $GLOBALS['site']; ?>/clientes/?sucesso=true">
	                                <div class="panel-footer">
	                                    <span class="pull-left">Ver detalhes</span>
	                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>
	                    <div class="col-lg-4 col-md-6">
	                        <div class="panel panel-red">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <i class="fa fa-users fa-5x"></i>
	                                    </div>
	                                    <div class="col-xs-9 text-right">
	                                        <div class="huge" id='quantErro'>0</div>
	                                        <div>Atualizados com erro</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <a href="/<?php echo $GLOBALS['site']; ?>/clientes/?erro=true" >
	                                <div class="panel-footer">
	                                    <span class="pull-left">Ver detalhes</span>
	                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>
	                    <div class="col-lg-4 col-md-6">
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <i class="fa fa-users fa-5x"></i>
	                                    </div>
	                                    <div class="col-xs-9 text-right">
	                                        <div class="huge" id='quantFalta'>0</div>
	                                        <div>Falta atualizar</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <a href="/<?php echo $GLOBALS['site']; ?>/clientes/?falta=true" >
	                                <div class="panel-footer">
	                                    <span class="pull-left">Ver detalhes</span>
	                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- /.container-fluid -->
	            
	        </div>
	        <!-- /#page-wrapper -->
	    </div>
	    <!-- /#wrapper -->
  
		<script src="../assets/js/jquery.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/bootstrap-table.js"></script>
		<script src="../assets/js/bootstrap-table-pt-BR.js"></script>
		<script type="text/javascript" src="home.js"></script>
		<script type="text/javascript">			
			$('.side-nav .home').addClass('active');

			var API_URL = 'http://' + location.host + '/'+ site +'/server/home/';
		
		</script>	
  	</body>  
</html>	