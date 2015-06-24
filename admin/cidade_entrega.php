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

    $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;
    if(isset($_SESSION['restaurante'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Entregas</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>

    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
</head>

<body>
    <div id="wrapper">

             <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                    <span><h2 class="admin">Administração</h2></span>
<?php if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);
} else {
    $restaurante_ativo = null;
}
$nivelUsuario = verificaNivelUsuario($_SESSION['id_nivel']);
?>

                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold nome_fantasia"><?=$restaurante_ativo['nome_fantasia']?></strong>
                             </span> <span class="text-muted text-xs block">&nbsp;&nbsp;<?= $_SESSION['nome'];?> </span>
                            <span class="admin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$nivelUsuario['sub_nome']?><br></span>
                             </span>
                    </div>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
                </li>
                <li>
                    <a href="timeline.php"><i class="fa fa-cutlery"></i> <span class="nav-label">Pedidos</span> </span>
                <?php
                    if(isset($_SESSION['restaurante'])){
                        $count = verificaQtdPedidosNav($_SESSION['restaurante']); ?>
                    <span class="label label-success pull-right"><?=$count['pedidos'];?></span>
                <?php } ?>
                </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plus"></i> <span class="nav-label">Gerenciar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="categorias.php">Categorias</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="adicionais.php">Adicionais</a></li>
                        <li><a href="bordas.php">Bordas Recheadas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="relatorioVendas.php">Vendas</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Administrar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="gerenciaRestaurantes.php">Restaurante</a></li>
                        <li><a href="gerenciaFuncionarios.php">Funcionarios</a></li>
                    </ul>
                </li>
                <li class="active">
                   <a href="cidade_entrega.php"><i class="fa fa-truck"></i> <span class="nav-label">Entregas</span></a>
                </li>
                <?php if($_SESSION['id_nivel'] == 5){ ?>
                <li>
                    <a href="cadastrar_cidade.php"><i class="fa fa-globe"></i> <span class="nav-label">Cadastrar Cidade</span></a>
                </li>
                <li>
                    <a href="restaurantes.php"><i class="fa fa-building-o"></i> <span class="nav-label">Alterar Resutaurante</span></a>
                </li>
                <?php } ?>
                <li>
                    <a href="login.php?logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Sair</span></a>
                </li>
            </ul>
        </div>
    </nav>

    
<?php

$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);

$cidades_entrega = busca_cidades_entregas_cadastradas($_SESSION['restaurante']);

$busca_cidades = mostra_cidades();

 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Entregas</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Entregas</strong>
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
                <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <form action="cadastrar.php" method="POST" accept-charset="utf-8">
                            <div class="input-group">
                            <div class="col-lg-5">
                            <label for="cidade">Cidade</label>
                                <select class="form-control" name="cidade" id="cidade">
                                <?php foreach($busca_cidades as $cidade): ?>
                                  <option value="<?=$cidade['id_cidade_entrega'];?>"><?=$cidade['nome'];?></option>
                                <?php endforeach; ?>
                                </select></div>
                                <div class="col-lg-3">
                                <label for="taxa">Taxa de Entrega</label>
                                <input type="text" class="form-control" name="taxa" id="taxa"></div>
                                <script type="text/javascript">$("#taxa").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                                <div class="col-lg-1">
                                <label for="">.</label>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-1x"></i> Cadastrar</button></div>
                            </div>
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Cidade</th>
                                <th>Cep</th>
                                <th>Taxa de Entrega</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($cidades_entrega as $cidade_entrega): ?>
                            <tr>
                                <td><?=$cidade_entrega['nome'];?></td>
                                <td><?=$cidade_entrega['cep'];?></td>
                                <td>R$ <?=$cidade_entrega['taxa'];?></td>
                                <td><a href="#"<i class="fa fa-pencil-square-o fa-1x"></i> Editar</a></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

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

</body>

</html>
<?php
    } else {
        $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar as Entregas";
        header('Location: restaurantes.php');
    }
} else {
    header('Location: login.php');
}
 ?>