<?php

$dsn = "mysql:host=mysql.hostinger.com.br;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "u288492055_admin";
$pass = "3eomu7hl69";

$pdo = new PDO($dsn, $usuario, $pass);

function lista_restaurantes($cep)
{
	global $pdo;
try{
	$sql = "SELECT r.id_restaurante as id_restaurante,
	    	   r.nome_fantasia as nome_fantasia,
	    	   r.tempo_entrega as tempo_entrega,
		       r.tipo as especialidade,
		       r.status as status,
		       r.logradouro as logradouro,
		       r.numero as numero,
		       r.bairro as bairro,
		       r.cidade as cidade,
		       r.fav as fav,
		       r.hora_abert as hora_abert,
		       r.hora_fech as hora_fech,
		       ce.nome as nome_cidade,
		       er.taxa as taxa_entrega,
		       ce.cep as cep,
		       ce.id_cidade_entrega as id_cidade_entrega


		from entregas_restaurantes er
		inner join restaurantes r
		on er.id_restaurante = r.id_restaurante
		inner join cidades_entregas ce
		on ce.id_cidade_entrega = er.id_cidade_entrega where cep = :cep AND status = 'Aberto'  AND fav != 1

		ORDER BY fav DESC, nome_fantasia ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam(':cep', $cep);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
    echo $e->getMessage();
	}
}

function lista_restaurantes_abert_fav($cep)
{
	global $pdo;
try{
	$sql = "SELECT r.id_restaurante as id_restaurante,
	    	   r.nome_fantasia as nome_fantasia,
	    	   r.tempo_entrega as tempo_entrega,
		       r.tipo as especialidade,
		       r.status as status,
		       r.logradouro as logradouro,
		       r.numero as numero,
		       r.bairro as bairro,
		       r.cidade as cidade,
		       r.fav as fav,
		       r.hora_abert as hora_abert,
		       r.hora_fech as hora_fech,
		       ce.nome as nome_cidade,
		       er.taxa as taxa_entrega,
		       ce.cep as cep,
		       ce.id_cidade_entrega as id_cidade_entrega


		from entregas_restaurantes er
		inner join restaurantes r
		on er.id_restaurante = r.id_restaurante
		inner join cidades_entregas ce
		on ce.id_cidade_entrega = er.id_cidade_entrega where cep = :cep AND status = 'Aberto' AND fav != 0

		ORDER BY fav DESC, nome_fantasia ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam(':cep', $cep);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
    echo $e->getMessage();
	}
}
function lista_restaurantes_fechados($cep)
{
	global $pdo;
try{
	$sql = "SELECT r.id_restaurante as id_restaurante,
	    	   r.nome_fantasia as nome_fantasia,
	    	   r.tempo_entrega as tempo_entrega,
		       r.tipo as especialidade,
		       r.status as status,
		       r.logradouro as logradouro,
		       r.numero as numero,
		       r.bairro as bairro,
		       r.cidade as cidade,
		       r.fav as fav,
		       r.hora_abert as hora_abert,
		       r.hora_fech as hora_fech,
		       ce.nome as nome_cidade,
		       er.taxa as taxa_entrega,
		       ce.cep as cep,
		       ce.id_cidade_entrega as id_cidade_entrega


		from entregas_restaurantes er
		inner join restaurantes r
		on er.id_restaurante = r.id_restaurante
		inner join cidades_entregas ce
		on ce.id_cidade_entrega = er.id_cidade_entrega where cep = :cep AND status = 'Fechado' AND fav != 1

		ORDER BY fav DESC, nome_fantasia ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam(':cep', $cep);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
    echo $e->getMessage();
	}
}

function lista_restaurantes_fechados_fav($cep)
{
	global $pdo;
try{
	$sql = "SELECT r.id_restaurante as id_restaurante,
	    	   r.nome_fantasia as nome_fantasia,
	    	   r.tempo_entrega as tempo_entrega,
		       r.tipo as especialidade,
		       r.status as status,
		       r.logradouro as logradouro,
		       r.numero as numero,
		       r.bairro as bairro,
		       r.cidade as cidade,
		       r.fav as fav,
		       r.hora_abert as hora_abert,
		       r.hora_fech as hora_fech,
		       ce.nome as nome_cidade,
		       er.taxa as taxa_entrega,
		       ce.cep as cep,
		       ce.id_cidade_entrega as id_cidade_entrega


		from entregas_restaurantes er
		inner join restaurantes r
		on er.id_restaurante = r.id_restaurante
		inner join cidades_entregas ce
		on ce.id_cidade_entrega = er.id_cidade_entrega where cep = :cep AND status = 'Fechado' AND fav != 0

		ORDER BY fav DESC, nome_fantasia ASC";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam(':cep', $cep);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
    echo $e->getMessage();
	}
}


function verificaRestauranteCep($cep)
{
	global $pdo;
try{
	$sql = "SELECT 	r.id_restaurante as id_restaurante,
		       	   	ce.cep as cep,
		       		ce.id_cidade_entrega as id_cidade_entrega


		from entregas_restaurantes er
		inner join restaurantes r
		on er.id_restaurante = r.id_restaurante
		inner join cidades_entregas ce
		on ce.id_cidade_entrega = er.id_cidade_entrega where cep = :cep";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam(':cep', $cep);
	$cmd->execute();

	return $cmd->fetchAll();

	$count = $cmd->fetchAll();

	if($count->rowCount() == 0){
		return false;
	}

}catch(PDOException $e){
    echo $e->getMessage();
	}
}

function mostra_infos_restaurante($id_restaurante,$cep)
{
	global $pdo;
try{
	$sql = "SELECT r.nome_fantasia as nome_fantasia,
				   r.compra_minima as compra_minima,
				   r.taxa_servico as taxa_servico,
			       er.taxa,
			       ce.cep


		FROM restaurantes r
		INNER JOIN entregas_restaurantes er
		ON r.id_restaurante = er.id_restaurante
		INNER JOIN cidades_entregas ce
		ON ce.id_cidade_entrega = er.id_cidade_entrega where cep = :cep and r.id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('cep',$cep);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
    echo $e->getMessage();
	}
}

function fechaRestaurantesMadrugaBoladona()
{
	global $pdo;
try{
	$sql = "UPDATE restaurantes SET status = 'Fechado'";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

}catch(PDOException $e){
    echo $e->getMessage();
	}
}