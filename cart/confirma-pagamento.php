<?php

	require '../functions/pedidos.php';
    require("pagarme-php/Pagarme.php");

    Pagarme::setApiKey("ak_test_7HtRGCqKKAlo8uZ4Nk5otJm2KOg9x0");

    $transaction = PagarMe_Transaction::findById($_POST['token']);
    $transaction->capture($_SESSION['grandTotal']*100);

    $TotalTaxAmount 	= 0;  //Sum of tax for all items in this order.
	$HandalingCost 		= $_SESSION['taxa_servico'];  //Handling cost for this order.
	$InsuranceCost 		= 0;  //shipping insurance cost for this order.
	$ShippinDiscount 	= 0; //Shipping discount for this order. Specify this as negative number.
	$ShippinCost 		= $_SESSION['taxa']; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

	foreach($_SESSION['products'] as $itm)
    {

		$valor = ($itm['valor'] + $itm['valor_borda'] + $itm['valor_adicional']);

		$desc = 'Adicional: '.$itm['adicional'].', Borda: '.$itm['borda'].'';

		// item price X quantity
	   	$subtotal = ($valor*$itm["qtd"]);

        //total price
        $ItemTotalPrice = $ItemTotalPrice + $subtotal;


		if($itm['cod_borda'] == 0){
			$itm['cod_borda'] = NULL;
		}
			if($itm['cod_adicional'] == 0){
				$itm['cod_adicional'] = NULL;
			}

	$itens_pedido[] = array('id_categoria'=>$itm['id_categoria'],
						  'produto'=>$itm['name'],
						  'qtd'=>$itm['qtd'],
						  'id_adicional'=>$itm['cod_adicional'],
						  'adicional'=>$itm['adicional'],
						  'id_borda'=>$itm['cod_borda'],
						  'borda'=>$itm['borda'],
						  'obs'=>$itm['obs'],
						  'valor'=>$valor);
    }

    $GrandTotal = ($ItemTotalPrice + $TotalTaxAmount + $HandalingCost + $InsuranceCost + $ShippinCost + $ShippinDiscount);

    $cidade_entrega = select_id_cidade_entrega($_SESSION['cep']);

    $id_cidade_entrega = $cidade_entrega['id_cidade_entrega'];

    	$endereco = select_endereco_entrega(14);

		$endereco_entrega = $endereco['logradouro'].', '.$endereco['numero'].' - '.
	        $endereco['bairro'].' / '. $endereco['cidade'].' - '.$endereco['estado'];

	        $vTotalPedido = $GrandTotal - $HandalingCost;
				inserir_pedido($vTotalPedido, $GrandTotal, $ShippinCost, $_SESSION['id_usuario'],
				  	$_SESSION['id_restaurante'], $id_cidade_entrega, $endereco_entrega);

						$id_pedido = $_SESSION['last_id'];

	insere_itens_pedido($id_pedido, $itens_pedido);

	$vPedido = ($GrandTotal - $HandalingCost - $ShippinCost);
	$tarifas_rest = buscaTarifasRestaurante($_SESSION['id_restaurante']);
	$taxa_pgto = $tarifas_rest['taxa_paypal'];
	$taxa_adm = $tarifas_rest['taxa_adm'];

	tarifas($_SESSION['id_restaurante'],$id_pedido,$vPedido,$taxa_pgto,$taxa_adm,$HandalingCost,$ShippinCost);
		
		unset($_SESSION["products"]);

		$lastid = $_SESSION['last_id'];
		update_pedido_sucess($lastid);
		updateStatusTarifa($lastid);
		unsets();
		$_SESSION['sucesso_pgto'] = 'Seu pagamento foi aceito e seu pedido foi encaminhado ao restaurante responsavel.';
		header('Location: success.php');

?>