<?php
if(!isset($_SESSION))
{
    session_start();
}

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);

function detalhaPedido($id_pedido)
{
	global $pdo;
try{
	$sql = "SELECT DATE_FORMAT(p.data,'%d/%m/%Y às %T') AS data_pedido,
				DATE_FORMAT(p.data_pgto,'%d/%m/%Y às %T') AS data_pgto,
				DATE_FORMAT(p.data_confirm,'%d/%m/%Y às %T') AS data_confirm,
				DATE_FORMAT(p.data_delivery,'%d/%m/%Y às %T') AS data_delivery,
				DATE_FORMAT(p.data_entrega,'%d/%m/%Y às %T') AS data_entrega,
				DATE_FORMAT(p.data_error,'%d/%m/%Y às %T') AS data_error,
				p.id_pedido AS id_pedido,
				p.endereco AS endereco,
				p.valor_pago AS valor_pago,
				sp.nome AS status,
				r.nome_fantasia AS restaurante,
				u.nome AS usuario,
				u.email AS email,
				u.celular AS celular

		FROM pedidos p
		INNER JOIN status_pgto sp
		ON p.id_status = sp.id_status
		INNER JOIN restaurantes r
		ON p.id_restaurante = r.id_restaurante
		INNER JOIN usuarios u
		ON p.id_usuario = u.id_usuario

		WHERE id_pedido = :id_pedido

			ORDER BY id_pedido DESC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_itens_pedido($id_pedido)
{
	global $pdo;
try{
	$sql = "SELECT  ip.produto as produto,
        			c.nome as categoria,
	       			ip.qtd as qtd,
	       			ip.adicional as adicional,
	       			ip.borda as borda,
	       			ip.obs as obs,
			       	ip.valor_unit as valor,
			       	(ip.qtd * ip.valor_unit) as subtotal

		FROM itens_pedido ip
      	INNER JOIN categorias c
      	ON ip.id_categoria = c.id_categoria 
        WHERE id_pedido = :id_pedido

      		ORDER BY ip.id_item_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}