<?php

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);

function mostra_categorias($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT * FROM categorias WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_produtos($id_categoria)
{
	global $pdo;
try {
	$sql = "SELECT	p.nome as nome_produto,
		 			p.descricao as descricao,
		      		p.id as codigo,
					p.valor as valor_unit,
		     		c.nome as categoria,
          			c.id_categoria as cod_categoria

			FROM produtos p
		  	INNER JOIN categorias c
		  	ON p.id_categoria = c.id_categoria WHERE p.id_categoria = :id_categoria";

	 $cmd = $pdo->prepare($sql);
	 $cmd->bindParam('id_categoria',$id_categoria);
	 $cmd->execute();

	 return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_add_produto($product_code)
{
	global $pdo;
try{
	$sql = "SELECT nome, valor FROM produtos
			WHERE id = :product_code
			LIMIT 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('product_code', $product_code);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_resumo_pedido($product_code)
{
	global $pdo;
try{
	$sql = "SELECT nome,descricao, valor FROM produtos
			WHERE id = :product_code
			LIMIT 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('product_code', $product_code);
	$cmd->execute();

	return $cmd->fetch();
}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_id_cidade_entrega($cep)
{
	global $pdo;
try{
	$sql = "SELECT id_cidade_entrega from cidades_entregas where cep = :cep";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('cep',$cep);
	$cmd->execute();

	return $cmd->fetch();
}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function inserir_pedido($ItemTotalPrice, $total_pago, $taxa_entrega, $id_usuario, $id_restaurante, $id_cidade_entrega,$endereco)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;
	
try{
	$sql = "INSERT INTO pedidos (data,valor_total,valor_pago,taxa_entrega,id_usuario,id_restaurante,id_status,id_cidade_entrega,endereco)
			VALUES(:data, :ItemTotalPrice, :total_pago, :taxa_entrega, :id_usuario,
					:id_restaurante, 1,
				   	:id_cidade_entrega,:endereco)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data', $data);
	$cmd->bindParam('ItemTotalPrice', $ItemTotalPrice);
	$cmd->bindParam('total_pago', $total_pago);
	$cmd->bindParam('taxa_entrega', $taxa_entrega);
	$cmd->bindParam('id_usuario',$id_usuario);
	$cmd->bindParam('id_restaurante', $id_restaurante);
	$cmd->bindParam('id_cidade_entrega', $id_cidade_entrega);
	$cmd->bindParam('endereco',$endereco);
	$cmd->execute();

$_SESSION['last_id'] = $pdo->lastInsertId();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_sucess($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 4, data_pgto = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data', $data);
	$cmd->bindParam('lastid', $lastid);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_error($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 3, data_error = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data', $data);
	$cmd->bindParam('lastid', $lastid);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_fail($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 2, data_error = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('lastid', $lastid);
	$cmd->bindParam('data', $data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function update_pedido_warning($lastid)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;

try{
	$sql = "UPDATE pedidos SET id_status = 10, data_error = :data
			WHERE id_pedido = :lastid";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('lastid', $lastid);
	$cmd->bindParam('data', $data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function insere_itens_pedido($id_pedido,$itens_pedido)
{
	global $pdo;

try{
	$sql = "INSERT INTO itens_pedido (id_pedido, id_produto, qtd, id_adicional, adicional, id_borda, borda, obs, valor_unit)
	        VALUES (:id_pedido, :id_produto, :qtd, :id_adicional, :adicional, :id_borda, :borda, :obs, :valor_unit)";

	$cmd = $pdo->prepare($sql);

	$cmd->bindParam('id_pedido', $id_pedido);

	foreach ($itens_pedido as $item)
	{
			$cmd->bindParam('id_produto', $item['itm_code']);
			$cmd->bindParam('qtd', $item['itm_qty']);
			$cmd->bindParam('id_adicional',	$item['cod_adic']);
			$cmd->bindParam('adicional', $item['itm_adic']);
			$cmd->bindParam('id_borda',	$item['cod_borda']);
			$cmd->bindParam('borda', $item['itm_borda']);
			$cmd->bindParam('obs', $item['itm_obs']);
			$cmd->bindParam('valor_unit', $item['itm_valor']);
			$cmd->execute();
	}
}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function unsets()
{
	unset($_SESSION['last_id']);
	unset($_SESSION["paypal_products"]);
	unset($_SESSION['id']);
	unset($_SESSION['id_restaurante']);
}

function lista_pedidos_limit5($id_usuario)
{
	global $pdo;
try{
	$sql = "SELECT p.id_pedido as num_pedido,
			       DATE_FORMAT(p.data,'%d %b %Y - %T') as data,
			       sp.nome as status,
			       p.valor_pago as valor_total

			FROM pedidos p
		    INNER JOIN status_pgto sp
		    ON p.id_status = sp.id_status
		    WHERE id_usuario = :id_usuario
			ORDER BY p.id_pedido DESC
			LIMIT 5";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario', $id_usuario);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_todos_pedidos($id_usuario)
{
	global $pdo;
try{
	$sql = "SELECT p.id_pedido as num_pedido,
			       DATE_FORMAT(p.data,'%d %b %Y - %T') as data,
			       sp.nome as status,
			       p.valor_pago as valor_total

			FROM pedidos p
		    INNER JOIN status_pgto sp
		    ON p.id_status = sp.id_status
		    WHERE id_usuario = :id_usuario
			ORDER BY p.id_pedido DESC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario', $id_usuario);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_itens_pedido($id_pedido)
{
	global $pdo;
try{
	$sql = "SELECT  p.nome as nome,
        			c.nome as categoria,
	       			ip.qtd as qtd,
	       			ip.adicional as adicional,
	       			ip.borda as borda,
	       			ip.obs as obs,
			       	ip.valor_unit as valor,
			       	(ip.qtd * ip.valor_unit) as subtotal,
			       	p.descricao as descricao

			FROM produtos p
      		INNER JOIN categorias c
      		ON p.id_categoria = c.id_categoria
			INNER JOIN itens_pedido ip
			ON ip.id_produto = p.id where id_pedido = :id_pedido

      		ORDER BY c.nome";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function detalhes_pedido($id_pedido)
{
	global $pdo;
try{
	$sql = "SELECT r.nome_fantasia as nome,
			       sp.nome as status,
			       ce.nome as cidade,
			       p.id_pedido as id_pedido,
			       p.endereco as endereco,
			       p.valor_pago as total_pago


			FROM pedidos p
			INNER JOIN restaurantes r
			ON p.id_restaurante = r.id_restaurante
		    INNER JOIN status_pgto sp
		    ON p.id_status = sp.id_status
			INNER JOIN cidades_entregas ce
			ON p.id_cidade_entrega = ce.id_cidade_entrega where id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_enderecos($id_usuario)
{
	global $pdo;
try{
	$sql = "SELECT * FROM enderecos WHERE id_usuario = :id_usuario";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario',$id_usuario);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_endereco_entrega($id_endereco)
{
		global $pdo;
try{
	$sql = "SELECT * FROM enderecos WHERE id_endereco = :id_endereco";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_endereco',$id_endereco);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_endereco_entrega_detalhes($id_pedido)
{
		global $pdo;
try{
	$sql = "SELECT * FROM pedidos WHERE id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_categoria($id_produto)
{
	global $pdo;
try{
	$sql = "SELECT p.id as id_produto,
			       c.nome as categoria

			FROM produtos p
			INNER JOIN categorias c
			ON p.id_categoria = c.id_categoria where id = :id_produto";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
function busca_adicionais($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM adicionais WHERE id_categoria = :id_categoria";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function busca_bordas($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM bordas WHERE id_categoria = :id_categoria";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaBorda($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM bordas WHERE id_categoria = :id_categoria";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	if($cmd->rowCount() > 0){
		return true;
	} else {
		return false;
	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaAdicional($id_categoria)
{
	global $pdo;
try{
	$sql = "SELECT * FROM adicionais WHERE id_categoria = :id_categoria";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

	if($cmd->rowCount() > 0){
		return true;
	} else {
		return false;
	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}


function select_add_adicionais($id_adicional)
{
	global $pdo;
try{
	$sql = "SELECT * FROM adicionais WHERE id_adicional = :id_adicional";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_adicional',$id_adicional);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function select_add_bordas($id_borda)
{
	global $pdo;
try{
	$sql = "SELECT * FROM bordas WHERE id_borda = :id_borda";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_borda',$id_borda);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function selectCidadesEntregas()
{
	global $pdo;
try{
	$sql = "SELECT ce.nome as nome,
       		ce.cep as cep

		FROM entregas_restaurantes er
		INNER JOIN cidades_entregas ce
		ON ce.id_cidade_entrega = er.id_cidade_entrega

		GROUP By nome
		ORDER BY nome ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function tarifas($id_restaurante,$id_pedido, $vPedido, $taxa_pgto, $taxa_adm, $servico, $taxa_entrega)
{
	$vTotal = (((($vPedido+$taxa_entrega)*($taxa_adm+$taxa_pgto))/100) + 0.6);
	$vLiq = $vPedido + $taxa_entrega - $vTotal;
	$vTotalPago = $vPedido + $servico + $taxa_entrega;
	$tarifas_pgto = (((($vPedido+$servico+$taxa_entrega)*$taxa_pgto)/100) + 0.6);
	$vLiquido_adm = (($vTotal+$servico)-($tarifas_pgto));
	$vTotal_tarifas = ($vTotal + $servico);

	$data =  date("Y-m-d H:i:s");;

	global $pdo;
try{
	$sql = "INSERT INTO tarifas (id_restaurante, id_pedido, data, vTotal_Pago, vTotal_Pedido,
				vLiquido_Restaurante, vLiquido_Adm, vTaxas_Restaurante, vTarifa_pgto, vTotal_Tarifas, taxa_adm)

 			VALUES (:id_restaurante, :id_pedido, :data, :vTotalPago, :vPedido,
 				:vLiq, :vLiquido_adm, :vTotal, :tarifas_pgto, :vTotal_tarifas, :taxa_adm)";

 	$cmd = $pdo->prepare($sql);
 	$cmd->bindParam('id_restaurante',$id_restaurante);
 	$cmd->bindParam('id_pedido',$id_pedido);
 	$cmd->bindParam('data',$data);
 	$cmd->bindParam('vTotalPago',$vTotalPago);
 	$cmd->bindParam('vPedido',$vPedido);
 	$cmd->bindParam('vLiq',$vLiq);
 	$cmd->bindParam('vLiquido_adm',$vLiquido_adm);
 	$cmd->bindParam('vTotal',$vTotal);
 	$cmd->bindParam('tarifas_pgto',$tarifas_pgto);
 	$cmd->bindParam('vTotal_tarifas',$vTotal_tarifas);
 	$cmd->bindParam('taxa_adm',$taxa_adm);
 	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function updateStatusTarifa($id_pedido)
{
	global $pdo;
try{
	$sql = "UPDATE tarifas SET status = 1 where id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaTarifasRestaurante($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT taxa_paypal, taxa_adm FROM restaurantes
				WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}