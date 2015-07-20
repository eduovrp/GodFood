<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
    require 'functions/functions.php';
    verifica_post();

    $current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;
    if(isset($_SESSION['restaurante'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Categorias</title>
    <link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/switchery/switchery.css" rel="stylesheet">

    <link rel="stylesheet" href="css/ladda.min.css">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
<?php if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);
} else {
    $restaurante_ativo = null;
}
$nivelUsuario = verificaNivelUsuario($_SESSION['id_nivel']);
?>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                    <img src="css/logo-branca.png" height="163" width="190" alt="GodFoo">
                    </div>
                </li>
                <li>
                    <a href="./"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
                </li>
                <li>
                    <a href="./pedidos"><i class="fa fa-cutlery"></i> <span class="nav-label">Pedidos</span> </span>
                <?php
                    if(isset($_SESSION['restaurante'])){
                        $count = verificaQtdPedidosNav($_SESSION['restaurante']); ?>
                    <span class="label label-success pull-right"><?=$count['pedidos'];?></span>
                <?php } ?>
                </a>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-plus"></i> <span class="nav-label">Gerenciar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="./categorias">Categorias</a></li>
                        <li><a href="./gerenciar/produtos">Produtos</a></li>
                        <li><a href="./adicionais">Adicionais</a></li>
                        <li><a href="./bordas">Bordas Recheadas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="./relatorios/vendas">Vendas</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Administrar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="./gerenciar/restaurantes">Restaurante</a></li>
                        <li><a href="./gerenciar/funcionarios">Funcionarios</a></li>
                    </ul>
                </li>
                <li>
                   <a href="./gerenciar/cidade-entrega"><i class="fa fa-truck"></i> <span class="nav-label">Entregas</span></a>
                </li>
                <?php if($_SESSION['id_nivel'] == 5){ ?>
                <li>
                    <a href="./pesquisa/pedidos"><i class="fa fa-search"></i> <span class="nav-label">Pesquisar Pedido </span></a>
                </li>
                <li>
                    <a href="./cadastrar-cidade"><i class="fa fa-globe"></i> <span class="nav-label">Cadastrar Cidade</span></a>
                </li>
                <li>
                    <a href="./restaurantes"><i class="fa fa-building-o"></i> <span class="nav-label">Alterar Restaurante</span></a>
                </li>
                <?php } ?>
                <li>
                    <a href="./entrar?logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Sair</span></a>
                </li>
            </ul>
        </div>
    </nav>
    
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="welcome-message">
                            <span class="m-r-sm text-muted welcome-message">Seja bem-vindo, <?=$_SESSION['nome']?></span>
                        </li>
                        <li class="logout">
                            <a href="./entrar?logout"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div> 

<?php $config = mostra_configs($_SESSION['restaurante']); 
    if($config['conf_borda'] > 0){
        $checked = 'checked';
    } else {
        $checked = '';
    }
    if($config['conf_adic'] > 0){
        $checked2 = 'checked';
    } else {
        $checked2 = '';
    }
    if($config['conf_2sabores'] > 0){
        $checked3 = 'checked';
    } else {
        $checked3 = '';
    }
?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Configurações</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="./">Inicio</a>
                        </li>
                        <li class="active">
                            Configurações
                        </li>
                    </ol>
                </div>
               <div class="col-sm-8">
                    <div class="title-action">
                        <h2 align="left"><?=$restaurante_ativo['nome_fantasia'];?></h2>
                    </div>
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php include 'mensagens.php'; ?>
               <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    </div>
                    <div class="ibox-content">
                        <form action="updates.php" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <h4> Aceitar borda recheada? (para pizzas, mini-pizzas, etc).</h4>
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" class="js-switch pull-right" name="conf_borda" <?=$checked?> />
                                </div>
                            </div>
                        </div>  
                        <br>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <h4> Aceitar adicionais?</h4>
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" class="js-switch_1 pull-right" name="conf_adic" <?=$checked2?> />
                                </div>
                            </div>
                        </div> 
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <h4> Aceitar dois sabores em um produto? (geralmente usados em pizzas meio a meio).</h4>
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" class="js-switch_2 pull-right" name="conf_2sabores" <?=$checked3?> />
                                </div>
                            </div>
                        </div> 
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="altera_configs" value="yep">
                                <button type="submit" class="btn btn-primary btn-block btn-outline">Salvar Configurações</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                            </div>
                        </div>
                    </div>

     </div>
            <div class="footer">
                <div>
                    <strong>Copyright &copy;</strong> - GodFood - Delivery  2015
                </div>
            </div>

        </div>
 </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <script src="js/plugins/ladda/spin.js"></script>
    <script src="js/plugins/ladda/ladda.js"></script>

    <!-- Scripts JS -->

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

    <!-- Switchery -->
   <script src="js/plugins/switchery/switchery.js"></script>

   <script type="text/javascript">
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });

        var elem = document.querySelector('.js-switch_1');
        var switchery = new Switchery(elem, { color: '#1AB394' });

        var elem = document.querySelector('.js-switch_2');
        var switchery = new Switchery(elem, { color: '#1AB394' });
   </script>


</body>

</html>
<?php
    } else {
        $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar as categorias";
        header('Location: ./restaurantes');
    }
} else {
    header('Location: ./entrar');
}
 ?>