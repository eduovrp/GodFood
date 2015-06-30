<?php

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);

function buscaDatasUltimoPedido($id_usuario)
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
				sp.nome as status

				FROM pedidos p
				INNER JOIN status_pgto sp
				ON p.id_status = sp.id_status

				WHERE id_usuario = :id_usuario

			ORDER BY id_pedido DESC
				LIMIT 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_usuario',$id_usuario);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}