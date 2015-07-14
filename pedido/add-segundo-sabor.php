<?php
if(!isset($_SESSION))
 {
   session_start();
 }
require '../functions/pedidos.php';

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add_segundo_sabor')
{
	$codigo2 	= filter_var($_POST["codigo"], FILTER_SANITIZE_STRING); //código do produto

	$_SESSION['categoria_in'] = $_POST['id_categoria']; //categoria escolhida


	$produtos = select_add_produto($codigo2);

		if(isset($_POST['doisSabores'])){
			if(isset($_SESSION['doisSabores'])){

				$dsb = $_SESSION['doisSabores'];

			$dsb['nome'] = $dsb['name'].'1/2 '.$produtos['nome'];
			$dsb['descricao'] = $dsb['descricao'].'1/2 '.$produtos['descricao'];

			if($dsb['valor'] > $produtos['valor']){
				$valor = $dsb['valor'];
			} else {
				$valor = $produtos['valor'];
			}

			$codigo = mt_rand(100,999);

			$new_product = array(array('name'=>$dsb['nome'], 'code'=>$codigo,
					'descricao'=>$dsb['descricao'], 'qtd'=>$dsb['qtd'],
					'valor'=>$valor, 'adicional'=>$dsb['adicional'],
					'valor_adicional'=>$dsb['valor_adicional'], 'cod_adicional'=>$dsb['cod_adicional'],
					'borda'=>$dsb['borda'], 'valor_borda'=>$dsb['valor_borda'], 'cod_borda'=>$dsb['cod_borda'], 
					'obs'=>$dsb['obs'], 'codigo1'=>$_SESSION['codigo1'], 'codigo2'=>$codigo2,
					'id_categoria'=>$_SESSION['id_categoria'], 'doisSabor'=>'sim',));

			unset($_SESSION['codigo1']);
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false

			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"],
					 'descricao'=>$cart_itm['descricao'], 'qtd'=>$cart_itm['qtd'],
					 'valor'=>$cart_itm["valor"], 'adicional'=>$cart_itm['adicional'],
					 'valor_adicional'=>$cart_itm['valor_adicional'], 'cod_adicional'=>$cart_itm['cod_adicional'],
					 'borda'=>$cart_itm['borda'], 'valor_borda'=>$cart_itm['valor_borda'], 'cod_borda'=>$cart_itm['cod_borda'],
					 'obs'=>$cart_itm['obs'],'codigo1'=>$cart_itm['codigo1'],
					 'codigo2'=>$cart_itm['codigo2'], 'id_categoria'=>$cart_itm['id_categoria'],'doisSabor'=>$cart_itm['doisSabor']);
					$found = true;
			}
		}

			if($found == true) //item não encontrado na matriz
			{
				//adiciona novo item ao array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//cria uma nova sessão se não existir com o produto
				$_SESSION["products"] = $new_product;
			}

			unset($_SESSION['doisSabores']);
			unset($_SESSION['id_categoria']);

	header('Location: ./produtos');


  		}	
	}
}
?>
