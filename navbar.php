<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php include('server/conexao.php'); ?>

        <a class="navbar-brand" href="/<?php echo $GLOBALS['site']; ?>/home/">
            <div class="navbar-brand name-system">Portal
            </div>
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
            <?php 
                $conn = mysqli_connect($GLOBALS['localhost'], $GLOBALS['root'],"", $GLOBALS['dbname']);
                $result = mysqli_query($conn,"SELECT * FROM usuario WHERE id='" . $_SESSION["usuario_id"] . "'");
                $row  = mysqli_fetch_array($result);
                    
                echo ucwords($row['USUARIO']);
             ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="/<?php echo $GLOBALS['site']; ?>/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">	
        	<li class="home">
        		<a href="/<?php echo $GLOBALS['site']; ?>/home/"><i class="fa fa-fw fa-home"></i> Home</a>
        	</li>
            <li class="clientes">
                <a href="/<?php echo $GLOBALS['site']; ?>/clientes/"><i class="fa fa-fw fa-users"></i> Clientes</a>
            </li>
            <li class="usuarios">
                <a href="/<?php echo $GLOBALS['site']; ?>/usuarios/"><i class="fa fa-fw fa-user"></i> Usuários</a>
            </li>
        </ul>
    </div>
</nav>

<script type="text/javascript">
    site = "<?php echo $GLOBALS['site']; ?>"
</script>
