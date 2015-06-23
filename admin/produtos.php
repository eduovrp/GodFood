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
    <link href="css/style_alternative.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
    

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

        <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Nome do Produto</label>
                            <input type="text" id="nome" name="nome" value="" placeholder="Nome do Produto" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                           <label for="valor">Valor</label>
                            <input type="text" class="form-control" name="valor" id="valor" id="valor" required>
                            <script type="text/javascript">$("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="descricao">Descrição</label>
                            <input type="text" id="descricao" name="descricao" value="" placeholder="Descrição" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Ativado</option>
                                <option value="0">Desativado</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-sm-1">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-1x"></i> Cadastrar</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
                <?php include 'mensagens.php'; ?>
               <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    <div class="row">
                        <div class="col-lg-12">
                        <form name="form_pesquisa" id="form_pesquisa" method="post" action="">
                            	<label for="nome">Buscar Produto</label>
                                <input type="text" class="form-control pesquisa" name="pesquisaProduto" id="pesquisaProduto" value="" placeholder="Pesquise por Nome, Categoria ou Descrição" tabindex="1">
                        </div>
                    </div>
                    <br>
                    <div id="contentLoading">
                         <div id="loading"></div>
                    </div>
                    <div class="ibox-content">
                       <div id="MostraPesq"></div>
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

    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
<script type="text/javascript">
        $(document).ready(function() {

            $('.footable').footable();

        });
 
$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
        $('#loading').html("<img src='css/loading.gif'/>").fadeIn('fast');
    }

    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }

    // aqui a fun?o ajax que busca os dados em outra pagina do tipo html, n? ?json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
                      loading_show();
                },
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
                    $(div).html(data).fadeIn();
                }
            });
    }

    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'PesqProdutos.php', '#MostraPesq');


    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaProduto').keyup(function(){

        //o serialize retorna uma string pronta para ser enviada
        var valores = $('#form_pesquisa').serialize()

        //pegando o valor do campo #pesquisaProduto
        var $parametro = $(this).val();

        if($parametro.length >= 1)
        {
            load_dados(valores, 'PesqProdutos.php', '#MostraPesq');
        }else
        {
            load_dados(null, 'PesqProdutos.php', '#MostraPesq');
        }
    });

    });
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