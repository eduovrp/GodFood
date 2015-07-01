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
require 'functions/timeline.php';

    verifica_post_tl();

    $_SESSION['return_url'] = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Pedidos</title>
    <link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
                <li class="active">
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

date_default_timezone_set('America/Sao_Paulo');
require '../functions/pedidos.php';

if(isset($_SESSION['restaurante']) && $_SESSION['restaurante'] > 1){
    $id_restaurante = $_SESSION['restaurante'];

$novosPedidos = mostraNovosPedidos($id_restaurante);
$pedidosEmAndamento = mostraPedidosEmAndamento($id_restaurante);
$detalhesPedidos = detalhaPedidosEmAndamento($id_restaurante);
$pedidosConcluidos = mostraPedidosConcluidos($id_restaurante);
 ?>
        <div id="page-wrapper" class="gray-bg">
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-8">
                    <div class="ibox">
                        <div class="ibox-content">

                            <h2>Pedidos</h2>
                            <p>
                                Clique no Pedido para ver os detalhes ao lado.
                            </p>
                            <div class="clients-list">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-bars"></i> Novos Pedidos</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-clock-o"></i> Pedidos em Andamento</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-check"></i> Pedidos Concluidos</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                             <?php foreach($novosPedidos as $novoPedido): ?>
                                        <tr data-toggle="tab" href="#pedido-<?=$novoPedido['id_pedido']; ?>" class="client-link-details">
                                            <td><?=$novoPedido['data'];?></td>
                                            <td><?="R$ " . number_format($novoPedido['valor_total'],2,",",".");?></td>
                                            <td><i class="fa fa-truck"> </i></td>
                                            <td><?=$novoPedido['endereco']; ?></td>
                                        </tr>
                            <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                  <tbody>
                             <?php foreach($pedidosEmAndamento as $emAndamento): ?>
                                                <tr data-toggle="tab" href="#pedido-<?=$emAndamento['id_pedido']; ?>" class="client-link-details">
                                                    <td><?=$emAndamento['data']; ?></td>
                                                    <td><?="R$ " . number_format($emAndamento['valor_total'],2,",","."); ?></td>
                                                    <td><i class="fa fa-truck"></i></td>
                                                    <td><?=$emAndamento['endereco']; ?></td>
                                                    <?php if($emAndamento['id_status']==5){ ?>
                                                    <td><span class="label label-info">EM PRODUÇÃO</span></td>
                                                    <?php } else if($emAndamento['id_status']==6){ ?>
                                                    <td><span class="label label-warning">SAIU PARA ENTREGA</span></td>
                                                    <?php } ?>

                                                </tr>
                             <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tab-3" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                            <thead>
                                                <tr class="client-link-head">
                                                    <td>Data do Pedido</td>
                                                    <td>Valor</td>
                                                    <td> </td>
                                                    <td>Tempo</td>
                                                    <td>Status</td>
                                                </tr>
                                            </thead>
                                                  <tbody>
                             <?php foreach($pedidosConcluidos as $pedidoConcluido):
                                $diff = s_datediff('i',$pedidoConcluido['data_pgto'], $pedidoConcluido['data_entrega']);
                                ?>
                                                <tr data-toggle="tab" href="#pedido-<?=$pedidoConcluido['id_pedido']; ?>" class="client-link">
                                                    <td><?=$pedidoConcluido['data']; ?></td>
                                                    <td><?="R$ " . number_format($pedidoConcluido['valor_total'],2,",","."); ?></td>
                                                    <td><i class="fa fa-clock-o"></i></td>
                                                    <td><?=round($diff)." minutos <br>"; ?></td>
                                                    <td><span class="label label-primary">CONCLUIDO</span></td>
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
                </div>
                <div class="col-sm-4">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="tab-content">
                            <?php foreach($detalhesPedidos as $detalhePedido): ?>
                                <div id="pedido-<?=$detalhePedido['id_pedido'];?>" class="tab-pane">
                                    <div class="m-b-lg">
                                            <h2>Pedido Nro. <?=$detalhePedido['id_pedido'] ;?></h2>

                                            <p>
                                                Pedido Realizado no dia <?=$detalhePedido['data'] ;?>
                                            </p>
                                            <br>
        <?php if($detalhePedido['id_status'] == 5){ ?>
        <a href="javascript:alterarStatusEntrega(<?= $detalhePedido['id_pedido']; ?>)" type="submit button" class="btn btn-block btn-outline btn-primary"><i class="fa fa-truck"></i> Pedido Pronto! Mande para a Entrega</a>
        <?php } else if($detalhePedido['id_status'] == 6){ ?>
        <a href="javascript:alterarStatusSucesso(<?= $detalhePedido['id_pedido']; ?>)" type="submit button" class="btn btn-block btn-outline btn-primary"><i class="fa fa-check"></i> Pedido entregue com Sucesso</a>
        <?php } ?>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong><h3>Produtos</h3></strong>

                                            <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Item</td>
                                                    <td align="center">Qtd</td>
                                                    <td align="right">Valor Unit</td>
                                                </tr>
                                            </thead>
                                                <tbody>

                                    <?php
                                        $itensPedido = lista_itens_pedido($detalhePedido['id_pedido']);
                                            foreach ($itensPedido as $item): ?>
                                            	<tr>
                                                    <td><?=$item['nome'] . " (".$item['categoria'].")";?></td>
                                                    <td align="center"><?=$item['qtd'];?></td>
                                                    <td align="right">R$ <?=number_format($item['valor'],2,",",".");?></td>
                                                </tr>
                                    <?php   endforeach; ?>
                                    			<?php if ($detalhePedido['taxa_entrega'] > 0): ?>
                                    				<tr>
                                    					<td>Taxa de Entrega</td>
                                    					<td></td>
                                    					<td align="right">R$ <?=number_format($detalhePedido['taxa_entrega'],2,",",".")?></td>
                                    				</tr>
                                    			<?php endif ?>
                                                </tbody>
                                            </table>
                                        <hr/>
                                        <span class="pull-right"><strong>Total R$ <?=number_format($detalhePedido['valor_total'],2,",",".");?></strong></span>
                                        <br>
                                        <hr/>
                                            <strong><h3>Endereço para entrega</h3></strong>
                                            <p><?= $detalhePedido['endereco'];?></p>
                                            <br>
                                            <strong><h3>Contato para entrega</h3></strong>
                                            <p><?= $detalhePedido['nome_cliente'];?> <br>
                                            <?= $detalhePedido['celular'];?></p>
                                            <hr/>
                                            <strong><h4>Detalhes dos Produtos</h4></strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                            <?php foreach($itensPedido as $item): ?>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-cutlery"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p><strong><?=$item['nome'] . " (".$item['categoria'].")";?></strong> <br>
                                                        <?= $item['descricao'];?>
                                                        </p>
                                                        <span class="vertical-date small text-muted"><strong> Adicional: <?=$item['adicional'];?></strong></span>
                                                        <br>
                                                        <span class="vertical-date small text-muted"><strong> Borda Recheada: <?=$item['borda'];?></strong></span>
                                                        <br>
                                                    <?php if(strlen($item['obs']) > 5): ?>
                                                        <span class="vertical-date small text-muted">Obs: <?=$item['obs'];?></span>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
        <?php if($detalhePedido['id_status'] == 4){ ?>
        <a href="javascript:confirmaPedido(<?= $detalhePedido['id_pedido']; ?>)" type="submit button" class="ladda-button btn btn-block btn-outline btn-primary" data-size="s" data-style="zoom-in"><i class="fa fa-check"></i> Confirmar Recebimento do Pedido</a>
        <?php } else if($detalhePedido['id_status'] == 5){ ?>
        <a href="javascript:alterarStatusEntrega(<?= $detalhePedido['id_pedido']; ?>)" type="submit button" class="ladda-button btn btn-block btn-outline btn-primary" data-size="s" data-style="zoom-in"><i class="fa fa-truck"></i> Pedido Pronto! Mande para a Entrega</a>
        <?php } else if($detalhePedido['id_status'] == 6){ ?>
        <a href="javascript:alterarStatusSucesso(<?= $detalhePedido['id_pedido']; ?>)" type="submit button" class="ladda-button btn btn-block btn-outline btn-primary" data-size="s" data-style="zoom-in"><i class="fa fa-check"></i> Pedido entregue com Sucesso</a>
        <?php } ?>
                                    <br>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>


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

    <form action="update_pedido.php" method="POST" id="confirmaPedido">
        <input type="hidden" name="idPedido">
        <input type="hidden" name="confirmaPedido" value="sim">
    </form>

    <form action="update_pedido.php" method="POST" id="alterarStatusEntrega">
        <input type="hidden" name="idPedido">
        <input type="hidden" name="confirmaPreparo" value="sim">
    </form>

    <form action="update_pedido.php" method="POST" id="alterarStatusSucesso">
        <input type="hidden" name="idPedido">
        <input type="hidden" name="confirmaEntrega" value="sim">
    </form>
<script>
    function confirmaPedido(idPedido){
        f = document.getElementById('confirmaPedido');
        f.idPedido.value = idPedido;
        f.submit();
    }
    function alterarStatusEntrega(idPedido){
        f = document.getElementById('alterarStatusEntrega');
        f.idPedido.value = idPedido;
        f.submit();
    }
    function alterarStatusSucesso(idPedido){
        f = document.getElementById('alterarStatusSucesso');
        f.idPedido.value = idPedido;
        f.submit();
    }

    $('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
</script>


</body>
</html>
<?php
    }else{
        $_SESSION['erros'] = "Para ver os pedidos é preciso selecionar um restaurante";
        header('Location: restaurantes.php');
    }
} else {
    header('Location: login.php');
}
?>