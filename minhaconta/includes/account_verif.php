<?php 

if($data['data_pedido'] != NULL){
	$data_pedido = $data['data_pedido'];
	$ok1 = 'ok';
} else {
	$data_pedido = 'Erro';
	$ok1 = '';
}

if($data['data_error'] == NULL){
	if($data['data_pgto'] != NULL){
		$data_pgto = $data['data_pgto'];
		$ok2 = 'ok';
	} else{
		$data_pgto = 'Em andamento';
		$ok2 = '';
	}
} else {
	$data_pgto = '<span class="erro">Erro ao efetuar pagamento</span>';
	$ok2 = '';
}

if($data['data_delivery'] != NULL){
	$data_preparo = $data['data_delivery'];
	$ok3 = 'ok';
} elseif($data['data_pgto']!= NULL && $data['data_delivery'] == NULL) {
	$data_preparo = 'Em andamento';
	$ok3 = '';
} else {
	$data_preparo = '';
	$ok3 = '';
}

if($data['data_entrega'] != NULL){
	$data_entrega = $data['data_entrega'];
	$ok4 = 'ok';
} elseif($data['data_delivery']!= NULL) {
	$data_entrega = 'Em Andamento';
	$ok4 = '';
} else{
	$data_entrega = '';
	$ok4 = '';
}