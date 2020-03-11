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
	                    <div class="col-lg-12">
	                        <h2 class="page-header">
	                            Clientes
	                        </h2>
	                    </div>
	                </div>
	                <div class="row">
	                 	<div class="col-lg-12">
	                 		<div id="toolbar" class="btn-group" style="padding: 7px">
								<span><a class="create-cliente btn btn-primary" href="javascript:">Novo cliente</a></span>
						 		<span class="alert"></span>
						 	</div>
                            <div class="table-responsive">
                                <table id="table-cliente" class="table table-hover table-striped" 
                                	data-search="true"
                                	data-toolbar="#toolbar"
                                	data-pagination="true"
						           	data-page-size="10"
						           	data-page-list="[5,10,20,50,100]"
						           	data-pagination-first-text="Primeira"
						           	data-pagination-pre-text="Anterior"
						           	data-pagination-next-text="Próxima"
						           	data-pagination-last-text="Última">
                                    <thead>
                                       	<tr>
                                       		<th data-field="action"
							                    data-align="center"
							                    data-formatter="actionEdit"
							                    data-events="actionEvents"></th>
									      	<th data-field="id" data-sortable="true">Código</th>
									      	<th data-field="codigoInterno" data-sortable="true">Código interno</th>
									      	<th data-field="nome" data-sortable="true">Nome</th>
									      	<th data-field="nomeVersao" data-sortable="true">Versão</th>
									      	<th data-field="cnpj">CNPJ</th>
									      	<th data-field="bloqueado" data-formatter="formatBloqueado">Bloqueado</th>
									      	<th data-align="center"
							                    data-formatter="formatButtons"
							                    data-events="actionEventsButtons"></th> 
							                <th data-align="center"
							                    data-formatter="formatButtonLib"
							                    data-events="actionEventsButtons"></th>    	
									    </tr>
								  	</thead>
                                </table>
                            </div>
	                    </div>
	                </div>
                <!-- /.row -->

	            </div>
	            <!-- /.container-fluid -->
	            <!-- <div class="logo-portal"></div> -->
	        </div>
	        <!-- /#page-wrapper -->

	    </div>
	    <!-- /#wrapper -->
  
		<div id="modal-cliente" class="modal fade">
	        <div class="modal-dialog">
	            <div class="modal-content">
		            <form data-toggle="validator" role="form">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title"></h4>
		                </div>
		                <div class="modal-body">
		                	<div class="alert-danger"></div>
		                	<div class="form-group">
		                        <label>Código</label>
		                        <input type="number" class="form-control" name="id" readonly="true">
		                    </div>
		                    <div class="form-group" data-toggle="validator">
		                        <label>Nome</label>
		                        <input type="text" class="form-control" name="nome" placeholder="Nome" required>
		                    </div>
		                    <div class="form-group">
		                        <label>Código interno</label>
		                        <input type="text" class="form-control" name="codigoInterno" placeholder="Cód. interno" required>
		                    </div>
		                    <div class="form-group" data-toggle="validator">
		                        <label>CNPJ</label>
		                        <input type="text" class="form-control" name="cnpj" placeholder="CNPJ" required>
		                    </div>
		                    <div class="form-group">
		                        <label>Dias para download de novas versões</label>
		                        <input type="number" class="form-control" name="quantDias" placeholder="Qtde. dias">
		                    </div>
		                    <div class="form-group">
		                        <label>Obs</label>
		                        <input type="text" class="form-control" name="obs" placeholder="Obs">
		                    </div>
		                    <input type="hidden" name="quantMinSinc">
		                    <input type="hidden" name="idVersao">
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-success submit">Salvar</button>
		                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		                </div>
		           	</form>
	            </div><!-- /.modal-content -->
	        </div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->

	    <div id="modal-versaomanual" class="modal fade">
	        <div class="modal-dialog">
	            <div class="modal-content">
		            <form data-toggle="validator" role="form">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title">Versão manual</h4>
		                </div>
		                <div class="modal-body">
		                	<div class="table-responsive">
                                <table id="table-versaomanual" class="table table-hover table-striped"
                                	data-pagination="true"	
						           	data-page-size="5"
						           	data-page-list="[5,10,20,50,100]"
						           	data-pagination-first-text="Primeira"
						           	data-pagination-pre-text="Anterior"
						           	data-pagination-next-text="Próxima"
						           	data-pagination-last-text="Última"
						           	data-query-params="queryParams">
                                    <thead>
                                       	<tr>
									      	<th data-field="id" data-sortable="true">Código</th>
									      	<th data-field="nome">Nome</th>
									      	<th data-field="dataDisp" data-formatter="formatDate" data-sortable="true">Disponível dia</th>
									      	<th data-align="center"
							                    data-formatter="formatBtnSelecionar"
							                    data-events="actionEventsButtons"></th>		      
									    </tr>
								  	</thead>
                                </table>
                            </div>
                            <input type="hidden" class="form-control" name="codigocliente">
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		                </div>
		           	</form>
	            </div><!-- /.modal-content -->
	        </div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->

	    <script src="../assets/js/jquery.js"></script>
	    <script src="../assets/js/moment-develop/min/moment-with-locales.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/bootstrap-table.js"></script>
		<script src="../assets/js/bootstrap-table-pt-BR.js"></script>
		<script src="../assets/js/validator.min.js"></script>
	    <script type="text/javascript" src="clientes.js"></script>
		<script type="text/javascript">
		    function actionEdit(value) {
		        return [
		            '<a class="update" href="javascript:" title="Editar cliente"><i class="glyphicon glyphicon-edit"></i></a>',
		            '<a class="remove" href="javascript:" title="Remover cliente"><i class="glyphicon glyphicon-remove-circle"></i></a>',
		        ].join(' ');
		    }
		    function formatBloqueado(value){
		    	return value == '1' ? 'Sim' : 'Não';
		    }
		    function formatButtons(value, row, index){
		    	return row['bloqueado'] == '1' ? 
		    		'<a class="liberar" href="javascript:" ><i class="btn btn-success">Liberar</i></a>' : 
		    		'<a class="bloquear" href="javascript:" ><i class="btn btn-danger">Bloquear</i></a>';
		    }
		    function formatButtonLib(value, row, index){
		    	return '<a class="versaomanual" href="javascript:" ><i class="btn btn-primary">Versão manual</i></a>';
			}
			function formatBtnSelecionar(value, row, index){
				return '<a class="selecionarversao" href="javascript:" ><i class="btn btn-primary">Selecionar</i></a>';	
			}
			function formatDate(value){
		    	return moment(value).format('DD/MM/Y HH:mm:ss');
		    }
		    function queryParams(params){
		    	return {
		    		bloqueado: 0
		    	}
		    }
		</script>
  	</body>  
</html>	