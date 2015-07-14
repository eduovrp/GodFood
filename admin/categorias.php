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
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

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

<?php $categorias = mostra_categorias($_SESSION['restaurante']); ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Categorias</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="./">Inicio</a>
                        </li>
                        <li>
                            Gerenciar
                        </li>
                        <li class="active">
                            <strong>Categorias</strong>
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
                        <form action="cadastrar.php" method="POST" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-6">
                            <label for="nome_categoria">Nome da Categoria</label>
                            <input type="text" class="form-control" name="nome_categoria" id="nome_categoria" placeholder="Nome da Categoria" required>
                            </div>
                            <div class="col-md-3">
                            <label for="2sabores">Aceitar 2 Sabores?</label>
                            <select name="2sabores" id="2sabores" class="form-control">
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                            </div>
                            <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button type="submit" class="ladda-button btn btn-primary btn-outline" data-size="s" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Cadastrar</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Nome</th>
                                <th>2 Sabores</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($categorias as $categoria): ?>
                            <tr>
                                <td><?=$categoria['id_categoria'];?></td>
                                <td><?=$categoria['nome'];?></td>
                                <td><?=$categoria['2sabores'];?></td>
                                <td><strong><a data-toggle="tab" href="#categoria-<?=$categoria['id_categoria'];?>" class="client-link-details"><i class="fa fa-pencil-square-o fa-1x"></i> Editar</a></td></strong>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>

                                <div class="col-sm-4">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="tab-content">
                            <?php foreach($categorias as $categoria): ?>
                                <div id="categoria-<?=$categoria['id_categoria'];?>" class="tab-pane">
                                    <div class="m-b-lg">
                                            <h2>Alterar Categoria <?=$categoria['id_categoria'] . "<br> (".$categoria['nome'].")";?></h2>
                                            <form action="updates.php" method="post" accept-charset="utf-8">
                                            <br>
                                             <h3>
                                            <label class="checkb">
                                                <input type="checkbox" class="i-checks" name="2sabores" <?php if($categoria['2sabores']=='Sim'){ echo 'checked'; }else{ echo'';}?> > Aceitar 2 sabores? </label>
                                            </h3>
                                            <label for="nome_categoria"></label>
                                                <div class="input-group"><input type="text" class="form-control" name="nome_categoria" id="nome_categoria" value="<?=$categoria['nome'];?>"> <span class="input-group-btn"> <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-1x"></i> Alterar</button></span></div>
                                                <input type="hidden" name="id_categoria" value="<?=$categoria['id_categoria'];?>">
                                            </form>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <form action="delete.php" method="POST" accept-charset="utf-8">
                                         <input type="hidden" name="excluir_categoria" value="<?=$categoria['id_categoria'];?>">
                                            <div class="col-md-offset-4">
                                            <div class="input-group"><button type="submit" class="ladda-button btn btn-danger btn-outline" data-size="s" data-style="zoom-in"><i class="fa fa-close fa-1x"></i> Excluir Categoria</button></div></div>
                                        </form>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                            </div>
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

        <!-- iCheck -->
    <script src="js/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
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