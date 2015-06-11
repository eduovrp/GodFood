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

    <title>GodFood | Inicio v.2</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
<?php
include 'includes/nav.html';
include 'includes/function_index.php';
?>

        <div id="page-wrapper" class="gray-bg">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Total</span>
                                <h5>Receita</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">

                                <?= number_format($rendaConfirmada['confirmada'],2,",",".");?>
                                </h1>
                                <?php

                                if($rendaConfirmada['confirmada'] < 1 || $valorTotal['total'] < 1){
                                    $pValorTotalRecebido = 0; ?>

                                <div class="tooltip-demo">
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Nenhum pedido foi confirmado ainda, aguarde.">
                                <div class="stat-percent font-bold text-success">0% <i class="fa fa-eye-slash"></i></div> </a> </div>

                                <?php } else {
                                $pValorTotalRecebido = (($rendaConfirmada['confirmada'] / $valorTotal['total']) * 100);
                                 ?>

                                <div class="tooltip-demo">
                                 <a href="#" data-toggle="tooltip" data-placement="right" title="R$ <?=number_format($valorTotal['total'],2,",",".");?> Receita bruta do total de Pedidos">
                                <div class="stat-percent font-bold text-success"><?=round($pValorTotalRecebido)."% ";?> <i class="fa fa-usd"></i></div></a></div>
                                <?php } ?>
                                <small>Total Bruto</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Anual</span>
                                <h5>Pedidos</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?= $pedConfirmados['confirmado'];?></h1>
                                <?php
                                if($pedConfirmados['confirmado'] < 1 || $totalPedidos['numero_pedido'] < 1){
                                    $porcentPedConfirmados = 0; ?>

                                <div class="tooltip-demo">
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Nenhum pedido foi confirmado ainda, aguarde.">
                                <div class="stat-percent font-bold text-info">0% <i class="fa fa-eye-slash"></i></div> </a> </div>
                                <?php } else {
                                $porcentPedConfirmados = (($pedConfirmados['confirmado'] / $totalPedidos['numero_pedido']) * 100);
                                 ?>
                                 <div class="tooltip-demo">
                                 <a href="#" data-toggle="tooltip" data-placement="right" title="<?=$pedConfirmados['confirmado'] ." de ". $totalPedidos['numero_pedido'];?>  pedidos foram confirmados">
                                <div class="stat-percent font-bold text-info"><?=round($porcentPedConfirmados)."% ";?><i class="fa fa-bolt"></i></div></a></div>
                                <?php } ?>
                                <small>em 2015</small>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right"><?= date('d/m');?></span>
                                <h5>Ultimos Pedidos</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=$pedidosDoDia['pedidos_dia'];?></h1>
                                <?php
                                $pedAtual = $pedidosDoDia['pedidos_dia'];

                                $pedAnt = $pedAntValido['pedDiaAnt'];
                                $porcent = 0;

                                if($pedAnt == 0) {
                            ?>
                            <div class="tooltip-demo">
                                <a href="#" data-toggle="tooltip" data-placement="right" title="Nenhum pedido encontrado nos ultimos 10 dias">
                            <div class="stat-percent font-bold text-navy">0% <i class="fa fa-eye-slash"></i></div> </a> </div>

                            <?php
                            } else {

                                while($pedAnt + (($porcent/100)*$pedAnt) < $pedAtual){
                                    $porcent = $porcent + 0.1;
                                }

                                while($pedAnt + (($porcent/100)*$pedAnt) > $pedAtual){
                                    $porcent = $porcent - 0.1;
                                }

                                if ($porcent >= 0){
                                ?>
                                <div class="tooltip-demo">
                                <a href="#" data-toggle="tooltip" data-placement="right" title="<?= round($porcent)."% ";?> de crescimento referente o ultimo dia">
                                <div class="stat-percent font-bold text-navy"><?= round($porcent)."% ";?><i class="fa fa-level-up"></i></div></a></div>
                                <?php } else if($porcent < 0 ){ ?>
                                <div class="tooltip-demo">
                                <a href="#" data-toggle="tooltip" data-placement="right" title="<?= round($porcent)."% ";?> de redução referente o ultimo dia">
                                <div class="stat-percent font-bold text-danger"><?= round($porcent)."% ";?><i class="fa fa-level-down"></i></div></a></div>
                                <?php }
                                } ?>
                                <small>Pedidos realizados hoje</small>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Total</span>
                                <h5>Usuarios</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?= $totalUsuarios['total_usuario']; ?></h1>
                                <small>Usuarios Cadastrados</small>
                            </div>
                        </div>
            </div>
        </div>
        <div class="row">
        <?php include 'mensagens.php';
            if(isset($_SESSION['restaurante'])){
                $status = verificaStatus($_SESSION['restaurante']);
                if($status['status'] == 'Fechado'){
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Atenção: </strong>Seu restaurante está fechado, <a class="alert-link" type="submit" href="javascript:abrirRestaurante(<?= $_SESSION['restaurante']; ?>)">clique aqui para abri-lo para pedidos online</a>.
            </div>
            <?php } elseif($status['status'] == 'Aberto'){ ?>
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                Seu restaurante está <strong>Aberto</strong>, <a class="alert-link" type="submit" href="javascript:fecharRestaurante(<?= $_SESSION['restaurante']; ?>)">deseja fecha-lo? Clique Aqui.</a>.
            </div>
            <?php }
            } ?>
        </div>

         <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pedidos Recentes</h5>
                        </div>
                        <div class="ibox-content">
                            <div id="morris-one-line-chart"></div>
                        </div>
                    </div>
                </div>
            <?php if($_SESSION['id_nivel'] != 5){ ?>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Produtos Mais Vendidos</h5>
                        </div>
                        <div class="ibox-content">
                            <div id="morris-donut-chart" ></div>
                        </div>
                    </div>
                </div>


            <?php } else { ?>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                    <div>
                                        <span class="pull-right text-right">
                                            <br/>
                                            Total recebido: R$ <?= number_format($totalLiquido['total_recebido'],2,",",".")?>
                                        </span>
                                        <h1 class="m-b-xs">R$ <?= number_format($totalLiquido['total_liquido_adm'],2,",",".")?></h1>
                                        <h3 class="font-bold no-margins">
                                            Valor total liquido.
                                        </h3>
                                        <small>dados referente ultimos dias</small>
                                    </div>

                                <div>
                                    <canvas id="lineChart"></canvas>
                                </div>
                                 <div class="m-t-md">
                                   <small>
                                       <strong>Record:</strong> o dia com o maior rendimento foi dia <strong><?=$record['data']?></strong> e teve um lucro de <strong>R$ <?= number_format($record['liquido_adm'],2,",",".")?></strong>
                                   </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>


        <div class="footer">
                <div>
                    <strong>Copyright &copy;</strong> - GodFood - Delivery  2015
                </div>
            </div>
        </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

            <!-- Morris -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

<?php
include 'includes/graficos.php';
?>

<form action="updates.php" method="POST" id="abrirRestaurante">
        <input type="hidden" name="id_restaurante">
        <input type="hidden" name="abrirRestaurante" value="sim">
</form>
<form action="updates.php" method="POST" id="fecharRestaurante">
        <input type="hidden" name="id_restaurante">
        <input type="hidden" name="fecharRestaurante" value="sim">
</form>
<script>
    function abrirRestaurante(id_restaurante){
        f = document.getElementById('abrirRestaurante');
        f.id_restaurante.value = id_restaurante;
        f.submit();
    }
    function fecharRestaurante(id_restaurante){
        f = document.getElementById('fecharRestaurante');
        f.id_restaurante.value = id_restaurante;
        f.submit();
    }
</script>

</body>
</html>
<?php
} else {
    header('Location: login.php');
}
 ?>