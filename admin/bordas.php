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

    $current_url = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Adicionais</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
</head>

<body>
    <div id="wrapper">
<?php
include 'includes/nav.html';

if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);
$bordas = lista_bordas($_SESSION['restaurante']);
$categorias = mostra_categorias($_SESSION['restaurante']);

 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Bordas Recheadas</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Bordas Recheadas</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                          <div class="col-md-5">
                          <h2 align="center"><?=$restaurante_ativo['nome_fantasia'];?></h2>
					      </div>
	                </div>
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php include 'mensagens.php'; ?>
               <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    <form action="cadastrar.php" method="POST" accept-charset="utf-8">
                            <div class="input-group">
                            	<div class="col-lg-5">
                            		<label for="nome">Nome</label>
                                	<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Ingrediente" tabindex="1" required> </div>
                                <div class="col-lg-2">
                                	<label for="valor">Valor</label>
                                	<input type="text" class="form-control" name="valor" id="valor" id="valor" tabindex="2" required></div>
                                	<script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                                <div class="col-lg-4">
                                	<label for="categoria">Categoria</label>
                                <select class="form-control" name="categoria" id="categoria" tabindex="3">
                                    <option value="0">Selecione a Categoria</option>
                            <?php foreach($categorias as $categoria): ?>
                                    <option value="<?=$categoria['id_categoria'];?>"
                            <?php if(isset($_SESSION['categoria']) && $_SESSION['categoria'] == $categoria['id_categoria']){
                                    echo 'selected';}?>> <?=$categoria['nome'];?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                                <div class="col-lg-1">
                                	<label for="">.</label>
                                	<button type="submit" class="btn btn-primary" tabindex="4"><i class="fa fa-check fa-1x"></i> Cadastrar</button></div>
                        	</div>
                            <input type="hidden" name="adicional" value="yep">
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Categoria</th>
                                <th>Nome do Ingrediente</th>
                                <th>Valor Unitário</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($bordas as $borda): ?>
                            <tr>
                                <td><?=$borda['id_borda'];?></td>
                                <td><?=$borda['categoria'];?></td>
                                <td><strong><?=$borda['nome'];?></strong></td>
                                <td>R$ <?=number_format($borda['valor'],2,",",".");?></td>
                                <td><a href="javascript:alterarDadosBorda(<?= $borda['id_borda']; ?>)"><i class="fa fa-pencil-square-o fa-1x"></i> Editar</a></td>
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

      <form action="alterarDadosBorda.php" method="POST" id="alterarDadosBorda">
        <input type="hidden" name="id_borda">
      </form>

<script>
     function alterarDadosBorda(id_borda){
        f = document.getElementById('alterarDadosBorda');
        f.id_borda.value = id_borda;
        f.submit();
    }
</script>
</body>

</html>
<?php
    } else {
    $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar os adicionais";
    header('Location: restaurantes.php');
    }
} else {
    header('Location: login.php');
}
 ?>