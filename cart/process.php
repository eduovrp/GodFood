<?php
header("Content-Type: text/html; charset=utf-8", true);

if(!isset($_SESSION))
 {
   session_start();
 }

date_default_timezone_set('America/Sao_Paulo');

require "config.php";
include "paypal.class.php";
require '../functions/pedidos.php';

$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

if($_POST) //Post Data received from product list page.
{

if(!isset($_POST['endereco'])){
 	$_SESSION['mensagem'] = "Você precisa escolher um endereço, caso não tenha nenhum cadastrado, por favor, cadastre <a href='cadastrar_enderecos.php'> clicando aqui </a>";
 	header('Location: view_cart.php');
} else {
	//Other important variables like tax, shipping cost
	$TotalTaxAmount 	= 0;  //Sum of tax for all items in this order.
	$HandalingCost 		= $_SESSION['taxa_servico'];  //Handling cost for this order.
	$InsuranceCost 		= 0;  //shipping insurance cost for this order.
	$ShippinDiscount 	= 0; //Shipping discount for this order. Specify this as negative number.
	$ShippinCost 		= $_SESSION['taxa']; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

	//we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
	//Please Note : People can manipulate hidden field amounts in form,
	//In practical world you must fetch actual price from database using item id.
	//eg : $ItemPrice = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
	$paypal_data ='';
	$ItemTotalPrice = 0;


    foreach($_SESSION['products'] as $key=>$itm)
    {

		$valor = ($itm['valor'] + $itm['valor_borda'] + $itm['valor_adicional']);

		$desc = 'Adicional: '.$itm['adicional'].', Borda: '.$itm['borda'].'';

        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($itm['name']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($itm['code']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_DESC'.$key.'='.urlencode($desc);
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($valor);
		$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($itm['qtd']);

		// item price X quantity
	   	$subtotal = ($valor*$itm["qtd"]);

        //total price
        $ItemTotalPrice = $ItemTotalPrice + $subtotal;

		//create items for session
		$paypal_product['items'][] = array('itm_name'=>$itm['name'],
											'itm_adic'=>$itm['adicional'],
											'itm_borda'=>$itm['borda'],
											'itm_price'=>$valor,
											'itm_code'=>$itm['code'],
											'itm_qty'=>$itm['qtd']
											);

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

    	$endereco = select_endereco_entrega($_POST['endereco']);

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


	$paypal_product['assets'] = array('tax_total'=>$TotalTaxAmount,
								'handaling_cost'=>$HandalingCost,
								'insurance_cost'=>$InsuranceCost,
								'shippin_discount'=>$ShippinDiscount,
								'shippin_cost'=>$ShippinCost,
								'grand_total'=>$GrandTotal);

	//create session array for later use
	$_SESSION["paypal_products"] = $paypal_product;

	//Parameters for SetExpressCheckout, which will be sent to PayPal
	$padata = 	'&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.
				'&NOSHIPPING=1'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
				'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
				'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
				'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
				'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&LOCALECODE=GB'. //PayPal pages to match the language on your website.
				//'&LOGOIMG=http://www.sanwebe.com/wp-content/themes/sanwebe/img/logo.png'. //site logo
				'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
				'&ALLOWNOTE=1';

		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
		$paypal= new MyPayPal();
		$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{
				//Redirect user to PayPal store with Token received.
			 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';

				header('Location: '.$paypalurl);
		}
		else
		{
			$lastid = $_SESSION['last_id'];
			update_pedido_error($lastid);
			$_SESSION['erro_pgto'] = 'Erro ao efetuar pagamento, por favor verifique os dados inseridos e tente novamente';
			header('Location: error.php');
		}
}
}

//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
	//we will be using these two variables to execute the "DoExpressCheckoutPayment"
	//Note: we haven't received any payment yet.

	$token = $_GET["token"];
	$payer_id = $_GET["PayerID"];

	//get session variables
	$paypal_product = $_SESSION["paypal_products"];
	$paypal_data = '';
	$ItemTotalPrice = 0;

    foreach($paypal_product['items'] as $key=>$p_item)
    {
		$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($p_item['itm_qty']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($p_item['itm_price']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($p_item['itm_name']);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($p_item['itm_code']);

		// item price X quantity
        $subtotal = ($p_item['itm_price']*$p_item['itm_qty']);

        //total price
        $ItemTotalPrice = ($ItemTotalPrice + $subtotal);
    }

	$padata = 	'&TOKEN='.urlencode($token).
				'&PAYERID='.urlencode($payer_id).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_TAXAMT='.urlencode($paypal_product['assets']['tax_total']).
				'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($paypal_product['assets']['shippin_cost']).
				'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($paypal_product['assets']['handaling_cost']).
				'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($paypal_product['assets']['shippin_discount']).
				'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($paypal_product['assets']['insurance_cost']).
				'&PAYMENTREQUEST_0_AMT='.urlencode($paypal_product['assets']['grand_total']).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);

	//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

	//Check if everything went ok..
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
	{

				if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{

					$lastid = $_SESSION['last_id'];
					update_pedido_sucess($lastid);
					updateStatusTarifa($lastid);
					unsets();
					$_SESSION['sucesso_pgto'] = 'Seu pagamento foi aceito e seu pedido foi encaminhado ao restaurante responsavel.';
					header('Location: success.php');
				}
				elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					$lastid = $_SESSION['last_id'];
					update_pedido_warning($lastid);
					unsets();
					$_SESSION['aviso_pgto'] = 'Transação completa, mas o pagamento ainda está pendente! Você precisa aceitar manualmente o pagamento na sua <a target="_new" href="http://www.paypal.com">Conta Paypal</a>';
					header('Location: warning.php');
				}

				// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
				// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
				$padata = 	'&TOKEN='.urlencode($token);
				$paypal= new MyPayPal();
				$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
				{

					$buyerName = urldecode($httpParsedResponseAr["FIRSTNAME"]).' '.urldecode($httpParsedResponseAr["LASTNAME"]);
					$buyerEmail = urldecode($httpParsedResponseAr["EMAIL"]);

				} else  {
					$lastid = $_SESSION['lastid'];
					update_pedido_fail($lastid);
					$_SESSION['erro_pgto'] = 'Erro ao efetuar pagamento, por favor verifique os dados inseridos e tente novamente';
					header('Location: error.php');
				}

	}else{
			$lastid = $_SESSION['lastid'];
			update_pedido_error($lastid);
			$_SESSION['erro_pgto'] = 'Erro ao efetuar pagamento, por favor verifique os dados inseridos e tente novamente';
			header('Location: error.php');
	}
}
?>