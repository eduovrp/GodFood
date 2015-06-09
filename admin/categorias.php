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

    <title>GodFood - Categorias</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
<?php
include 'includes/nav.html';
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);
$categorias = mostra_categorias($_SESSION['restaurante']);
 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Categorias</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Inicio</a>
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
                <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <form action="cadastrar.php" method="POST" accept-charset="utf-8">
                        <div class="input-group"><input type="text" class="form-control" name="nome_categoria"> <span class="input-group-btn"> <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-1x"></i> Cadastrar</button></span></div>
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Nome</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($categorias as $categoria): ?>
                            <tr>
                                <td><?=$categoria['id_categoria'];?></td>
                                <td><?=$categoria['nome'];?></td>
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
                                            <label for="nome_categoria"></label>
                                                <div class="input-group"><input type="text" class="form-control" name="nome_categoria" id="nome_categoria" value="<?=$categoria['nome'];?>"> <span class="input-group-btn"> <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-1x"></i> Alterar</button></span></div>
                                                <input type="hidden" name="id_categoria" value="<?=$categoria['id_categoria'];?>">
                                            </form>
                                    </div>
                                    <div class="row">
                                        <form action="delete.php" method="POST" accept-charset="utf-8">
                                         <input type="hidden" name="excluir_categoria" value="<?=$categoria['id_categoria'];?>">
                                            <div class="col-md-offset-4">
                                            <div class="input-group"><button type="submit" class="btn btn-danger btn-outline"><i class="fa fa-close fa-1x"></i> Excluir Categoria</button></div></div>
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


</body>

</html>
<?php
    } else {
        $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar as categorias";
        header('Location: restaurantes.php');
    }
} else {
    header('Location: login.php');
}
 ?>