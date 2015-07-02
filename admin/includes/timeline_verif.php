<?php 

if($detalhes['data_pedido'] != NULL){
	$data_pedido = $detalhes['data_pedido'];
	$ok1 = 'ok';
} else {
	$data_pedido = 'Erro';
	$ok1 = '';
}

if($detalhes['data_error'] == NULL){
	if($detalhes['data_pgto'] != NULL){
		$data_pgto = $detalhes['data_pgto'];
		$ok2 = 'ok';
	} else{
		$data_pgto = 'Em andamento';
		$ok2 = '';
	}
} else {
	$data_pgto = '<span class="erro">Erro ao efetuar pagamento</span>';
	$ok2 = '';
}

if($detalhes['data_delivery'] != NULL){
	$data_preparo = $detalhes['data_delivery'];
	$ok3 = 'ok';
} elseif($detalhes['data_pgto']!= NULL && $detalhes['data_delivery'] == NULL) {
	$data_preparo = 'Em andamento';
	$ok3 = '';
} else {
	$data_preparo = '';
	$ok3 = '';
}

if($detalhes['data_entrega'] != NULL){
	$data_entrega = $detalhes['data_entrega'];
	$ok4 = 'ok';
} elseif($detalhes['data_delivery']!= NULL) {
	$data_entrega = 'Em Andamento';
	$ok4 = '';
} else{
	$data_entrega = '';
	$ok4 = '';
}