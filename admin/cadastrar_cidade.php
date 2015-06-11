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
    if($_SESSION['id_nivel'] == 5){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Cadastrar Cidade</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
</head>

<body>
    <div id="wrapper">
<?php
include 'includes/nav.html';
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);

$busca_cidades = mostra_cidades();

 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Cadastrar Cidades</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Cadastrar Cidades</strong>
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
                            <div class="col-lg-6">
                            <label for="cidade">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control"></div>
                                <div class="col-lg-3">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" name="cep" id="cep"></div>
                                <div class="col-lg-1">
                                <label for="">.</label>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-1x"></i> Cadastrar</button></div>
                            </div>
                            <input type="hidden" name="cadastrarCidade" value="yep">
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Cidade</th>
                                <th>Cep</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($busca_cidades as $cidades): ?>
                            <tr>
                                <td><?=$cidades['nome'];?></td>
                                <td><?=$cidades['cep'];?></td>
                                <td><a href="delete.php?id_cidade=<?=$cidades['id_cidade_entrega']?>"><i class="fa fa-close fa-1x"></i> Excluir</a></td>
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


    <script src="js/jquery.mask.js" type="text/javascript"></script>
        <script type="text/javascript">
      $(document).ready(function(){
        $('#cep').mask('99999-999');
      });
    </script>

</body>

</html>
<?php
    } else {
        $_SESSION['erros'] = "Você não tem permissão para acessar essa pagina!";
        header('Location: index.php');
    }
} else {
    header('Location: login.php');
}
 ?>