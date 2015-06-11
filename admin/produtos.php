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

    <title>GodFood - Produtos</title>

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
$produtos = lista_produtos($_SESSION['restaurante']);
$categorias = mostra_categorias($_SESSION['restaurante']);

 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Produtos</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Produtos</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                          <div class="col-md-5">
                          <h2 align="center"><?=$restaurante_ativo['nome_fantasia'];?></h2>
                          <form action="cadastrar.php" method="POST" accept-charset="utf-8">
                          <?php if($restaurante_ativo != null){ ?>
					        <select class="form-control" name="categoria" id="categoria">
					           <option value="0">Selecione a Categoria</option>
					           <?php
								foreach($categorias as $categoria): ?>
									<option value="<?=$categoria['id_categoria'];?>"
                                        <?php if(isset($_SESSION['categoria']) && $_SESSION['categoria'] == $categoria['id_categoria']){
                                             echo 'selected';}?>>
                                    <?=$categoria['nome'];?>
                                    </option>
								<?php endforeach; ?>
					        </select>
					        <?php } ?>
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
                            <div class="input-group">
                            	<div class="col-lg-4">
                            		<label for="nome">Nome</label>
                                	<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Produto" required> </div>
                                <div class="col-lg-2">
                                	<label for="valor">Valor</label>
                                	<input type="text" class="form-control" name="valor" id="valor" id="valor" required></div>
                                	<script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                                <div class="col-lg-5">
                                	<label for="descricao">Descrição</label>
                                	<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição"></div>
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
                                <th>Código</th>
                                <th>Categoria</th>
                                <th>Nome do Produto</th>
                                <th>Descrição</th>
                                <th>Valor Unitário</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($produtos as $produto): ?>
                            <tr>
                                <td><?=$produto['codigo'];?></td>
                                <td><?=$produto['categoria'];?></td>
                                <td><strong><?=$produto['nome_produto'];?></strong></td>
                                <td class="nome_f"><?=$produto['descricao'];?></td>
                                <td>R$ <?=number_format($produto['valor_unit'],2,",",".");?></td>
                                <td><a href="javascript:alterarDadosProduto(<?= $produto['codigo']; ?>)"><i class="fa fa-pencil-square-o fa-1x"></i> Editar</a></td>
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

      <form action="alterarDadosProduto.php" method="POST" id="alterarDadosProduto">
        <input type="hidden" name="id_produto">
      </form>

<script>
     function alterarDadosProduto(id_produto){
        f = document.getElementById('alterarDadosProduto');
        f.id_produto.value = id_produto;
        f.submit();
    }
</script>
</body>

</html>
<?php
    } else {
    $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar os produtos";
    header('Location: restaurantes.php');
    }
} else {
    header('Location: login.php');
}
 ?>