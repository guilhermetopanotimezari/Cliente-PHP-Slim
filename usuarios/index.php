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
        <meta charset="UTF-8">
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
                                Usuários
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="create-usuario btn btn-primary" href="javascript:">Novo usuário</a>
                            <span class="alert"></span>
                            <div class="table-responsive">
                                <table id="table-usuarios" class="table table-hover table-striped"
                                    data-search="true"
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
                                                data-formatter="actionFormatter"
                                                data-events="actionEvents"></th>
                                            <th data-field="id" data-sortable="true">Código</th>
                                            <th data-field="nome" data-sortable="true">Nome</th>
                                            <th data-field="usuario" data-sortable="true">Usuário</th>  
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <div id="modal-usuarios" class="modal fade">
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
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="form-group" data-toggle="validator">
                                <label>Usuário</label>
                                <input type="text" class="form-control" name="usuario" required>
                            </div>
                            <div class="form-group" data-toggle="validator">
                                <label>Senha</label>
                                <input type="text" class="form-control" name="senha" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success submit">Salvar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap-table.js"></script>
        <script src="../assets/js/bootstrap-table-pt-BR.js"></script>
        <script src="../assets/js/validator.min.js"></script>
        <script src="../assets/js/moment-develop/min/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="usuarios.js"></script>
        <script type="text/javascript">
            function actionFormatter(value) {
                return [
                    '<a class="update" href="javascript:" title="Editar usuário"><i class="glyphicon glyphicon-edit"></i></a>'/*,
                    '<a class="remove" href="javascript:" title="Remover usuário"><i class="glyphicon glyphicon-remove-circle"></i></a>',*/
                ].join(' ');
            }
        </script>
    </body>  
</html> 