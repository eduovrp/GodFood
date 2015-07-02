<?php

if(!isset($_SESSION))
{
    session_start();
}

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);


function pesquisaAdicionais($parametro, $id_restaurante)
{
	global $pdo;
try{

	$parametro = "%".$parametro."%";

	$sql = "SELECT a.nome AS nome,
			a.id_adicional AS id_adicional,
			a.valor AS valor,
			c.nome AS categoria,
			c.id_restaurante AS id_restaurante,
			a.status AS status

		FROM adicionais a
		INNER JOIN categorias c
		ON a.id_categoria = c.id_categoria WHERE c.id_restaurante = :id_restaurante
			AND a.nome LIKE :parametro OR c.id_restaurante = :id_restaurante AND c.nome LIKE :parametro

				ORDER BY c.nome";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('parametro',$parametro);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function pesquisaBordas($parametro, $id_restaurante)
{
	global $pdo;
try{

	$parametro = "%".$parametro."%";

	$sql = "SELECT b.nome AS nome,
				b.id_borda AS id_borda,
				b.valor AS valor,
				c.nome AS categoria,
				c.id_restaurante AS id_restaurante,
				b.status AS status

			FROM bordas b
		INNER JOIN categorias c
		ON b.id_categoria = c.id_categoria WHERE c.id_restaurante = :id_restaurante
			AND b.nome LIKE :parametro OR c.id_restaurante = :id_restaurante AND c.nome LIKE :parametro

				ORDER BY c.nome";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('parametro',$parametro);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function pesquisaProdutos($parametro, $id_restaurante)
{
	global $pdo;
try{

	$parametro = "%".$parametro."%";

	$sql = "SELECT p.nome AS nome_produto,
				p.descricao AS descricao,
				p.id AS codigo,
				p.valor AS valor_unit,
				c.nome AS categoria,
				p.id_restaurante AS cod_restaurante,
				p.status AS status

			FROM produtos p
			INNER JOIN categorias c
			ON p.id_categoria = c.id_categoria 
			WHERE p.id_restaurante = :id_restaurante AND p.nome LIKE :parametro 
				OR p.id_restaurante = :id_restaurante AND c.nome LIKE :parametro 
				OR p.id_restaurante = :id_restaurante AND p.descricao LIKE :parametro

					ORDER BY c.nome ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('parametro',$parametro);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaStatusPagamento()
{
	global $pdo;
try{
	$sql = "SELECT * FROM status_pgto";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function pesquisaPedidos($parametro, $data1, $data2)
{
	global $pdo;
try{
	$parametro2 = $parametro;
	$parametro = "%".$parametro."%";
	

	$sql = "SELECT p.id_pedido AS id_pedido,
				   DATE_FORMAT(p.data,'%d/%m/%Y às %T') AS data_pedido,
				   p.valor_pago AS valor_pago,
				   p.id_status AS status,
				   p.endereco AS endereco,
				   r.nome_fantasia AS restaurante

			FROM pedidos p
			INNER JOIN status_pgto sp
			ON p.id_status = sp.id_status
			INNER JOIN restaurantes r
			ON p.id_restaurante = r.id_restaurante
			WHERE  p.data >= :data1 AND p.data <= :data2 AND sp.status_reduzido LIKE :parametro
				OR p.data >= :data1 AND p.data <= :data2 AND r.nome_fantasia LIKE :parametro
				OR p.id_pedido = :parametro2
					ORDER BY p.id_pedido DESC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data1',$data1);
	$cmd->bindParam('data2',$data2);
	$cmd->bindParam('parametro',$parametro);
	$cmd->bindParam('parametro2',$parametro2);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}