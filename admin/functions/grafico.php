<?php
if(!isset($_SESSION))
{
    session_start();
}

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);

function mostraDadosUltimos8diasTotal()
{
	global $pdo;
try{
	$sql = "SELECT COUNT(DATE_FORMAT(data, '%Y-%m-%d')) AS data_count, LEFT(data,10) AS data
			FROM pedidos WHERE id_status = 7

		GROUP BY DATE_FORMAT(data, '%Y-%m-%d')
  			ORDER BY DATE_FORMAT(data, '%Y-%m-%d') DESC
  				LIMIT 8";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosUltimos8diasTotalR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT COUNT(DATE_FORMAT(data, '%Y-%m-%d')) AS data_count, LEFT(data,10) AS data
			FROM pedidos WHERE id_restaurante = :id_restaurante AND id_status = 7

		GROUP BY DATE_FORMAT(data, '%Y-%m-%d')
  			ORDER BY DATE_FORMAT(data, '%Y/%m/%d') DESC
  				LIMIT 8";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function produtos_mais_vendidosR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT COUNT(p.id) AS qtd,
			      CONCAT(LEFT(p.nome,13),' (',c.nome,')') AS nome,
			      r.nome_fantasia AS nome_restaurante

			FROM itens_pedido ip
			INNER JOIN produtos p
			ON ip.id_produto = p.id
			INNER JOIN categorias c
			ON p.id_categoria = c.id_categoria
			INNER JOIN restaurantes r
			ON p.id_restaurante = r.id_restaurante WHERE r.id_restaurante = :id_restaurante


		group by nome
			order by qtd DESC
				LIMIT 10";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraValoresLiquido()
{
	global $pdo;
try{
	$sql = "SELECT SUM(vLiquido_Restaurante) AS liquido_rest,
       			   SUM(vLiquido_Adm) AS liquido_adm,
       			   DATE_FORMAT(data, '%d/%m') AS data

			FROM tarifas WHERE status = 1
				GROUP BY DATE_FORMAT(data, '%d/%m')
					ORDER BY DATE_FORMAT(data, '%Y/%m/%d') DESC
						LIMIT 8";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraValoresLiquidoR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT SUM(vLiquido_Restaurante) AS liquido_rest,
       			   SUM(vLiquido_Adm) AS liquido_adm,
       			   DATE_FORMAT(data, '%d/%m') AS data

			FROM tarifas WHERE status = 1 AND id_restaurante = :id_restaurante
				GROUP BY DATE_FORMAT(data, '%d/%m')
					ORDER BY DATE_FORMAT(data, '%Y/%m/%d') DESC
						LIMIT 8";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}