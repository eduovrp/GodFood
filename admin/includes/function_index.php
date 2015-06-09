<?php 

date_default_timezone_set('America/Sao_Paulo');

$_SESSION['diaAnt'] = (date('d') - 1);

$totalUsuarios = totalUsuarios();

if(isset($_SESSION['restaurante'])){
$id_restaurante = $_SESSION['restaurante'];

$totalPedidos = totalPedidosR($id_restaurante);
$valorTotal = valorTotalPedidosR($id_restaurante);
$pedidosDoDia = totalPedidosDoDiaR($id_restaurante);
$pedConfirmados = mostraPedidosConfirmadosR($id_restaurante);
$rendaConfirmada = mostraRendaTotalConfirmadaR($id_restaurante);
$verificaDia = verificaDiaUltimoPedidoR($_SESSION['diaAnt'],$id_restaurante);
$pedAntValido = mostraQtdPedidosUltimoDiaR($_SESSION['diaAnt'],$id_restaurante);

if(isset($_SESSION['id_nivel']) == 5){
	$totalLiquido = mostraTotalLiquidoRecebidoR($id_restaurante);
	$record = mostraRecordDeLucroR($id_restaurante);
}

} else {

$totalPedidos = totalPedidos();
$valorTotal = valorTotalPedidos();
$pedidosDoDia = totalPedidosDoDia();
$pedConfirmados = mostraPedidosConfirmados();
$rendaConfirmada = mostraRendaTotalConfirmada();
$verificaDia = verificaDiaUltimoPedido($_SESSION['diaAnt']);
$pedAntValido = mostraQtdPedidosUltimoDia($_SESSION['diaAnt']);

if(isset($_SESSION['id_nivel']) == 5){
	$totalLiquido = mostraTotalLiquidoRecebido();
	$record = mostraRecordDeLucro();
}

}

