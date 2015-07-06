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
    if(isset($_POST['id_restaurante'])){

    if($_SESSION['id_nivel'] != 5){
      $disabled = 'disabled="disabled"';
    } else {
      $disabled = "";
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Alterar Dados</title>
    <link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

    <link rel="stylesheet" href="css/ladda.min.css">
    
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
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
                <li>
                   <a href="cidade_entrega.php"><i class="fa fa-truck"></i> <span class="nav-label">Entregas</span></a>
                </li>
                <?php if($_SESSION['id_nivel'] == 5){ ?>
                <li>
                    <a href="pesquisa-pedidos.php"><i class="fa fa-search"></i> <span class="nav-label">Pesquisar Pedido </span></a>
                </li>
                <li>
                    <a href="cadastrar_cidade.php"><i class="fa fa-globe"></i> <span class="nav-label">Cadastrar Cidade</span></a>
                </li>
                <li>
                    <a href="restaurantes.php"><i class="fa fa-building-o"></i> <span class="nav-label">Alterar Restaurante</span></a>
                </li>
                <?php } ?>
                <li>
                    <a href="login.php?logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Sair</span></a>
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
                            <a href="login.php?logout"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div> 
    
<?php
$_SESSION['restaurante'] = $_POST['id_restaurante'];

$restaurante = mostraDadosRestaurante($_POST['id_restaurante']);
if($restaurante['fav'] > 0){
  $checked = "checked";
} else{
  $checked = "";
}
 ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Alterar Dados</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Alterar Dados</strong>
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
                <div class="col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">

                    <form action="updates.php" method="POST">
                      <h2>Alteração de dados
                        <label class="checkb">
                          <input type="checkbox" class="i-checks" name="fav" <?=$checked?> <?=$disabled?>> Favorito </label>
                      </h2>
                    </div>
                    <div class="ibox-content">
                       <div class="input-group">
                           <div class="row">
                               <div class="col-md-8">
                                   <label for="razao">Razao Social</label>
                                    <input type="text" class="form-control" name="razao" id="razao" value="<?=$restaurante['razao_social']?>"<?=$disabled?>>
                               </div>
                                <div class="col-md-4">
                                   <label for="tipo">Tipo</label>
                                    <input type="text" class="form-control" name="tipo" id="tipo" value="<?=$restaurante['tipo']?>" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-6">
                                   <label for="cnpj">CNPJ</label>
                                    <input type="text" class="form-control" name="cnpj" id="cnpj" value="<?=$restaurante['cnpj']?>"<?=$disabled?>>
                               </div>
                                <div class="col-md-6">
                                   <label for="fone">Telefone</label>
                                    <input type="text" class="form-control" name="fone" id="fone" value="<?=$restaurante['fone']?>" required>
                               </div>
                           </div>
                           <br>
                             <div class="row">
                               <div class="col-md-8">
                                   <label for="nome_fantasia">Nome de Fantasia</label>
                                    <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?=$restaurante['nome_fantasia']?>" required>
                               </div>
                                <div class="col-md-4">
                                   <label for="tempo_entrega">Tempo de Entrega</label>
                                    <input type="text" class="form-control" name="tempo_entrega" id="tempo_entrega" value="<?=$restaurante['tempo_entrega']?>" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-10">
                                   <label for="logradouro">Logradouro</label>
                                    <input type="text" class="form-control" name="logradouro" id="logradouro" value="<?=$restaurante['logradouro']?>" required>
                               </div>
                                <div class="col-md-2">
                                   <label for="numero">Numero</label>
                                    <input type="text" class="form-control" name="numero" id="numero" value="<?=$restaurante['numero']?>" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-5">
                                   <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro" value="<?=$restaurante['bairro']?>" required>
                               </div>
                                <div class="col-md-7">
                                   <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" id="cidade" value="<?=$restaurante['cidade']?>" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-3">
                                   <label for="hora_abert">Horário de Abertura</label>
                                    <input type="text" class="form-control" name="hora_abert" id="hora_abert" value="<?=$restaurante['hora_abert']?>" required>
                               </div>
                                <div class="col-md-3">
                                   <label for="hora_fech">Horário de Encerramento</label>
                                    <input type="text" class="form-control" name="hora_fech" id="hora_fech" value="<?=$restaurante['hora_fech']?>" required>
                               </div>
                               <div class="col-md-3">
                                   <label for="compra_min">Compra Minima</label>
                                   <?php $compra_min = str_replace(".",",", $restaurante['compra_minima']);?>
                                    <input type="text" class="form-control" name="compra_min" id="compra_min" value="<?=$compra_min?>" required>
                                    <script type="text/javascript">$("#compra_min").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});</script>
                               </div>
                               <div class="col-md-3">
                                   <label for="taxa_servico">Taxa de Serviço</label>
                                   <?php $taxa_servico = str_replace(".",",", $restaurante['taxa_servico']);?>
                                    <input type="text" class="form-control" name="taxa_servico" id="taxa_servico" value="<?=$taxa_servico?>" required <?=$disabled?>>
                                    <script type="text/javascript">$("#taxa_servico").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});</script>
                               </div>
                           </div>
                              <?php if($_SESSION['id_nivel'] == 5){ ?>
                              <br>
                            <div class="row">
                              <div class="col-md-3">
                                   <label for="taxa_adm">Taxa Administrativa %</label>
                                   <?php $taxa_adm = str_replace(".",",", $restaurante['taxa_adm']);?>
                                    <input type="text" class="form-control" name="taxa_adm" id="taxa_adm" value="<?=$taxa_adm?>" required <?=$disabled?>>
                                    <script type="text/javascript">$("#taxa_adm").maskMoney({prefix:'% ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});</script>
                               </div>
                            </div>
                            <?php } ?> 
                          <br>
                        <div align="right">
                          <input type="hidden" name="alterarDadosRestaurante" value="alterar">
                            <a href="gerenciaRestaurantes.php" type="button" class="btn btn-danger btn-lg btn-outline"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
                            &nbsp;&nbsp;
                            <button type="submit" class="btn ladda-button btn-primary btn-lg btn-outline" data-size="m" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Atualizar</button>
                          </form>
                          </div>
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

    <script src="js/plugins/ladda/spin.js"></script>
    <script src="js/plugins/ladda/ladda.js"></script>

    <!-- Scripts JS -->

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

        <!--Mascaras -->
    <script type="text/JavaScript" src="js/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#cnpj').mask('99.999.999/9999-99');
        $('#fone').mask('(99) - 9999-9999');
        $('#hora_abert').mask('00:00');
        $('#hora_fech').mask('00:00');
      });

      $("form").submit(function() {
        $("input").removeAttr("disabled");
      });
    </script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

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
      header('Location: gerenciaRestaurantes.php');
  }
} else {
    header('Location: login.php');
}
 ?>

