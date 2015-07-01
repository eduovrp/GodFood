<?php
if(!isset($_SESSION))
{
    session_start();
}
date_default_timezone_set('America/Sao_Paulo');
$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";

$pdo = new PDO($dsn, $usuario, $pass);

function mostraNovosPedidos($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT id_pedido, DATE_FORMAT(data,'%d/%m as %T') as data, valor_total, endereco
			FROM pedidos
			WHERE id_status = 4 AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function atualizaPedidoRecebido($id_pedido)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;
try{
	$sql = "UPDATE pedidos SET id_status = 5, data_confirm = :data WHERE id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->bindParam('data',$data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraPedidosEmAndamento($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT id_pedido, DATE_FORMAT(data,'%d/%m as %T') as data, valor_total, endereco, id_status
			FROM pedidos
			WHERE id_status = 5 AND id_restaurante = :id_restaurante OR id_status = 6 AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function detalhaPedidosEmAndamento($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT p.id_pedido AS id_pedido, 
			      DATE_FORMAT(p.data,'%d/%m/%Y as %T') AS data, 
			      p.valor_total AS valor_total, 
			      p.taxa_entrega AS taxa_entrega, 
			      p.endereco AS endereco, 
			      p.id_status AS id_status,
			      u.nome AS nome_cliente,
			      u.celular AS celular
            
	  	FROM pedidos p
      	INNER JOIN usuarios u
      	ON p.id_usuario = u.id_usuario

      		WHERE p.id_restaurante = :id_restaurante
				ORDER BY p.data";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraPedidosConcluidos($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT id_pedido, DATE_FORMAT(data,'%d/%m/%Y às %T') as data,
					data_entrega,
					data_pgto,
					valor_total, endereco, id_status

			FROM pedidos
			WHERE id_status = 7 AND id_restaurante = :id_restaurante

			ORDER BY data_entrega DESC
				LIMIT 30";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function atualizaPedidoParaEntrega($id_pedido)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;
try{
	$sql = "UPDATE pedidos SET id_status = 6, data_delivery = :data WHERE id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->bindParam('data',$data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function atualizaPedidoSucesso($id_pedido)
{
	$data =  date("Y-m-d H:i:s");
	global $pdo;
try{
	$sql = "UPDATE pedidos SET id_status = 7, data_entrega = :data WHERE id_pedido = :id_pedido";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_pedido',$id_pedido);
	$cmd->bindParam('data',$data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verifica_post_tl()
{
	if(isset($_POST['restaurante']) && $_POST['restaurante'] > 0){
        $_SESSION['restaurante'] = $_POST['restaurante'];
    } else if(isset($_POST['restaurante']) && $_POST['restaurante'] == 0){
        unset($_SESSION['restaurante']);
    }

    if(isset($_POST['categoria']) && $_POST['categoria'] > 0){
        $_SESSION['categoria'] = $_POST['categoria'];
    } else if(isset($_POST['categoria']) && $_POST['categoria'] == 0){
        unset($_SESSION['categoria']);
    }
}

function s_datediff( $str_interval, $dt_menor, $dt_maior, $relative=false){

       if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
       if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

       $diff = date_diff( $dt_menor, $dt_maior, ! $relative);

       switch( $str_interval){
           case "i":
               $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
               break;
          }
       if( $diff->invert)
               return -1 * $total;
       else    return $total;
   }

function verificaQtdPedidosNav($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT COUNT(id_pedido) AS pedidos FROM pedidos
			WHERE id_status = 4 AND id_restaurante = :id_restaurante OR id_status = 5 AND id_restaurante = :id_restaurante OR id_status = 6 AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaNivelUsuario($id_nivel)
{
	global $pdo;
try{
	$sql = "SELECT sub_nome FROM niveis_usuarios WHERE id_nivel = :id_nivel";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_nivel',$id_nivel);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_restaurante_ativo($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT nome_fantasia, id_restaurante FROM restaurantes where id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}