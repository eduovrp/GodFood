<?php

if(!isset($_SESSION))
{
    session_start();
}

$dsn = 'mysql:host=localhost;dbname=u288492055_food;charset=utf8';
$usuario = 'root';
$pass = '';

$pdo = new PDO($dsn, $usuario, $pass);

function totalPedidos()
{
	global $pdo;
try{
	$sql = "SELECT count(id_pedido) AS numero_pedido FROM pedidos";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function totalPedidosR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT count(id_pedido) AS numero_pedido FROM pedidos
				WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function valorTotalPedidos()
{
	global $pdo;
try{
	$sql = "SELECT SUM(valor_total) AS total FROM pedidos";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function valorTotalPedidosR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT SUM(valor_total) AS total FROM pedidos
				WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function totalPedidosDoDia()
{
		global $pdo;
try{
	$sql = "SELECT count(id_pedido) as pedidos_dia FROM pedidos
			WHERE day(data) = day(now())";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function totalPedidosDoDiaR($id_restaurante)
{
		global $pdo;
try{
	$sql = "SELECT count(id_pedido) as pedidos_dia FROM pedidos
				WHERE day(data) = day(now()) AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function totalUsuarios()
{
	global $pdo;
try{
	$sql = "SELECT count(id_usuario) AS total_usuario FROM usuarios";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaDiaUltimoPedido($diaAnt)
{
	date_default_timezone_set('America/Sao_Paulo');

	$_SESSION['diaAnt'] = $diaAnt;
	global $pdo;
try{

	$sql = "SELECT count(id_pedido) as pedDiaAnt FROM pedidos
			WHERE day(data) = :diaAnt";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('diaAnt',$diaAnt);
	$cmd->execute();

	$count = $cmd->fetch();

	if($count['pedDiaAnt'] > 0){
		return $cmd->fetch();
		} else{

		$_SESSION['diaAnt'] = $_SESSION['diaAnt'] - 1;
		$countDia = (date('d') - $_SESSION['diaAnt']);

			if($countDia <= 10){
				verificaDiaUltimoPedido($_SESSION['diaAnt']);
			} else {
				return $cmd->fetch();
			}
		}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaDiaUltimoPedidoR($diaAnt,$id_restaurante)
{
	date_default_timezone_set('America/Sao_Paulo');

	$_SESSION['diaAnt'] = $diaAnt;
	global $pdo;
try{

	$sql = "SELECT count(id_pedido) as pedDiaAnt FROM pedidos
			WHERE day(data) = :diaAnt AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('diaAnt',$diaAnt);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	$count = $cmd->fetch();

	if($count['pedDiaAnt'] > 0){
		return $cmd->fetch();
		} else{

		$_SESSION['diaAnt'] = $_SESSION['diaAnt'] - 1;
		$countDia = (date('d') - $_SESSION['diaAnt']);

			if($countDia <= 10){
				verificaDiaUltimoPedidoR($_SESSION['diaAnt'],$id_restaurante);
			} else {
				return $cmd->fetch();
			}
		}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraQtdPedidosUltimoDia($diaAnt)
{
	global $pdo;
try{

	$sql = "SELECT count(id_pedido) as pedDiaAnt FROM pedidos
			WHERE day(data) = :diaAnt";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('diaAnt',$diaAnt);
	$cmd->execute();

		return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraQtdPedidosUltimoDiaR($diaAnt,$id_restaurante)
{
	global $pdo;
try{

	$sql = "SELECT count(id_pedido) as pedDiaAnt FROM pedidos
			WHERE day(data) = :diaAnt AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('diaAnt',$diaAnt);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

		return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraPedidosConfirmados()
{
	global $pdo;
try{
	$sql = "SELECT count(id_status) as confirmado FROM pedidos
			WHERE id_status = 7";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraPedidosConfirmadosR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT count(id_status) as confirmado FROM pedidos
			WHERE id_restaurante = :id_restaurante AND id_status = 7";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraRendaTotalConfirmada()
{
	global $pdo;
try{
	$sql = "SELECT SUM(valor_total) AS confirmada FROM pedidos
			WHERE id_status = 7";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraRendaTotalConfirmadaR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT SUM(valor_total) AS confirmada FROM pedidos
			WHERE id_status = 7 AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function busca_restaurantes()
{
	global $pdo;
try{
	 $sql = "SELECT id_restaurante, nome_fantasia
	 		 FROM restaurantes
	 		 	ORDER BY nome_fantasia ASC";

	 $cmd = $pdo->prepare($sql);
	 $cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
function busca_categorias($restaurante)
{
	global $pdo;
try{
	$sql = "SELECT id_categoria, nome, id_restaurante FROM categorias
			WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_restaurante_ativo($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT nome_fantasia, id_restaurante FROM restaurantes
				WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

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
function cadastra_categoria($nome,$id_restaurante)
{
	global $pdo;
try{
	$sql = "INSERT INTO categorias (nome,id_restaurante)
			VALUES (:nome, :id_restaurante)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
function lista_produtos($id_restaurante)
{
	global $pdo;
try {
	$sql = "SELECT 	p.nome AS nome_produto,
		 			p.descricao AS descricao,
		      		p.id AS codigo,
					p.valor AS valor_unit,
		     		c.nome AS categoria,
          			p.id_restaurante AS cod_restaurante

			FROM produtos p
		  	INNER JOIN categorias c
		  	ON p.id_categoria = c.id_categoria WHERE p.id_restaurante = :id_restaurante

		  	ORDER BY categoria ASC";

	 $cmd = $pdo->prepare($sql);
	 $cmd->bindParam('id_restaurante',$id_restaurante);
	 $cmd->execute();

	 return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
function cadastra_produto($nome,$valor,$descricao,$id_restaurante,$id_categoria)
{
	global $pdo;
try{
	$sql = "INSERT INTO produtos (nome, valor, id_restaurante, descricao, id_categoria)
					 	  VALUES (:nome, :valor, :restaurante, :descricao, :categoria)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('valor',$valor);
	$cmd->bindParam('restaurante',$id_restaurante);
	$cmd->bindParam('descricao',$descricao);
	$cmd->bindParam('categoria',$id_categoria);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
function verifica_post()
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
function lista_todos_produtos()
{
	global $pdo;
try {
	$sql = "SELECT 	p.nome AS nome_produto,
		 			p.descricao AS descricao,
		      		p.id AS codigo,
					p.valor AS valor_unit,
		     		c.nome AS categoria,
          			p.id_restaurante AS cod_restaurante

			FROM produtos p
		  	INNER JOIN categorias c
		  	ON p.id_categoria = c.id_categoria

		  	ORDER BY categoria ASC";

	 $cmd = $pdo->prepare($sql);
	 $cmd->bindParam('id_restaurante',$id_restaurante);
	 $cmd->execute();

	 return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}
function busca_cidades_entregas_cadastradas($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT 	ce.nome AS nome,
       				ce.cep AS cep,
       				er.taxa AS taxa

			FROM entregas_restaurantes er
			INNER JOIN cidades_entregas ce
			ON ce.id_cidade_entrega = er.id_cidade_entrega

			WHERE er.id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostra_cidades()
{
	global $pdo;
try{
	$sql = "SELECT * FROM cidades_entregas";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function cadastra_cidade_entrega($id_cidade_entrega, $id_restaurante, $taxa)
{
	global $pdo;
try{
	$sql = "INSERT INTO entregas_restaurantes (id_cidade_entrega, id_restaurante, taxa)
			VALUES(:id_cidade_entrega, :id_restaurante, :taxa)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_cidade_entrega',$id_cidade_entrega);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('taxa',$taxa);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verifica_categoria($id_categoria,$id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT * FROM categorias
			WHERE id_categoria = :id_categoria AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function altera_categoria($nome,$id_categoria,$id_restaurante)
{
	global $pdo;
try{
	$sql = "UPDATE categorias SET nome = :nome
			WHERE id_categoria = :id_categoria AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function exclui_categoria($id_categoria,$id_restaurante)
{
	global $pdo;
try{

	$verifica = "SELECT id FROM produtos WHERE id_categoria = :id_categoria";

	$stmt = $pdo->prepare($verifica);
	$stmt->bindParam('id_categoria',$id_categoria);
	$stmt->execute();

	$stmt->fetch();

	if($stmt->rowCount() > 0){
		$_SESSION['erros'] = "Existem produtos cadastrados nessa categoria, você não pode exclui-la.";
	} else {

	$sql = "DELETE FROM categorias
			WHERE id_categoria = :id_categoria AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	$_SESSION['msg_sucesso'] = "Categoria excluida com sucesso";
  	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraRestaurantesCadastrados()
{
	global $pdo;
try{
	$sql = 'SELECT * FROM restaurantes';

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function gerenciaDadosRestaurante($id_restaurante)
{
	global $pdo;
try{
	$sql = 'SELECT * FROM restaurantes WHERE id_restaurante = :id_restaurante';

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosRestaurante($id_restaurante)
{
	global $pdo;
try{
	$sql = 'SELECT * FROM restaurantes WHERE id_restaurante = :id_restaurante';

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function cadastraRestaurante($razao_social, $tipo, $cnpj, $fone, $nome_fantasia, $tempo_entrega,
					$logradouro, $numero, $bairro, $cidade, $hora_abert, $hora_fech, $compra_minima)
{
	global $pdo;
try{
	$sql = "INSERT INTO restaurantes (tipo, tempo_entrega, razao_social, cnpj, fone, nome_fantasia,
										logradouro, numero, bairro, cidade, hora_abert, hora_fech, compra_minima)
			VALUES (:tipo, :tempo_entrega, :razao_social, :cnpj, :fone, :nome_fantasia, :logradouro,
					:numero, :bairro, :cidade, :hora_abert, :hora_fech, :compra_minima)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('tipo',$tipo);
	$cmd->bindParam('tempo_entrega',$tempo_entrega);
	$cmd->bindParam('razao_social',$razao_social);
	$cmd->bindParam('cnpj',$cnpj);
	$cmd->bindParam('fone',$fone);
	$cmd->bindParam('nome_fantasia',$nome_fantasia);
	$cmd->bindParam('logradouro',$logradouro);
	$cmd->bindParam('numero',$numero);
	$cmd->bindParam('bairro',$bairro);
	$cmd->bindParam('cidade',$cidade);
	$cmd->bindParam('hora_abert',$hora_abert);
	$cmd->bindParam('hora_fech',$hora_fech);
	$cmd->bindParam('compra_minima',$compra_minima);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function alterarDadosRestaurante($razao_social, $tipo, $cnpj, $fone, $nome_fantasia, $tempo_entrega,
					$logradouro, $numero, $bairro, $cidade, $hora_abert, $hora_fech, $taxa_servico,
					$compra_minima, $fav, $id_restaurante,$taxa_adm)
{
	global $pdo;
try{
	$sql = "UPDATE restaurantes SET tipo = :tipo, tempo_entrega = :tempo_entrega, razao_social = :razao_social,
				cnpj = :cnpj, fone = :fone, nome_fantasia = :nome_fantasia, logradouro = :logradouro, numero = :numero,
				bairro = :bairro, cidade = :cidade, fav = :fav, hora_abert = :hora_abert, hora_fech = :hora_fech,
				compra_minima = :compra_minima, taxa_servico = :taxa_servico, taxa_adm = :taxa_adm WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('tipo',$tipo);
	$cmd->bindParam('tempo_entrega',$tempo_entrega);
	$cmd->bindParam('razao_social',$razao_social);
	$cmd->bindParam('cnpj',$cnpj);
	$cmd->bindParam('fone',$fone);
	$cmd->bindParam('nome_fantasia',$nome_fantasia);
	$cmd->bindParam('logradouro',$logradouro);
	$cmd->bindParam('numero',$numero);
	$cmd->bindParam('bairro',$bairro);
	$cmd->bindParam('cidade',$cidade);
	$cmd->bindParam('fav',$fav);
	$cmd->bindParam('hora_abert',$hora_abert);
	$cmd->bindParam('hora_fech',$hora_fech);
	$cmd->bindParam('compra_minima',$compra_minima);
	$cmd->bindParam('taxa_servico',$taxa_servico);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('taxa_adm',$taxa_adm);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function alteraStatusAberto($id_restaurante)
{
	global $pdo;
try{
	$sql = "UPDATE restaurantes SET status = 'Aberto' WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaStatus($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT status, id_restaurante FROM restaurantes WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function alteraStatusFechado($id_restaurante)
{
	global $pdo;
try{
	$sql = "UPDATE restaurantes SET status = 'Fechado' WHERE id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaQtdPedidosNav($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT COUNT(id_pedido) AS pedidos FROM pedidos
				WHERE id_status = 4 AND id_restaurante = :id_restaurante
						OR id_status = 5 AND id_restaurante = :id_restaurante
							OR id_status = 6 AND id_restaurante = :id_restaurante";

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

function buscaFuncionarios($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT 	f.nome AS nome,
					f.id_funcionario AS id_funcionario,
			       	f.cpf AS cpf,
			       	f.usuario AS usuario,
			       	nu.sub_nome AS nivel,
			       	f.telefone AS telefone,
			       	DATE_FORMAT(f.data,'%d/%m/%Y') as data

		FROM funcionarios f
		INNER JOIN niveis_usuarios nu
		ON f.id_nivel = nu.id_nivel WHERE f.id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaNiveisUsuarios()
{
	global $pdo;
try{
	$sql = "SELECT id_nivel, sub_nome FROM niveis_usuarios
			WHERE id_nivel = 2 OR id_nivel = 3 OR id_nivel = 4";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function cadastraFuncionario($nome,$cpf,$telefone,$id_nivel,$usuario,$senha,$id_restaurante)
{
	$senha = sha1($senha);
    $senha_hash = hash('sha512',$senha);
    $data =  date("Y-m-d H:i:s");

	global $pdo;
try{
	$sql = "INSERT INTO funcionarios (nome, cpf, telefone, usuario, senha, id_nivel, id_restaurante, data)
			VALUES (:nome, :cpf, :telefone, :usuario, :senha_hash, :id_nivel, :id_restaurante, :data)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('cpf',$cpf);
	$cmd->bindParam('telefone',$telefone);
	$cmd->bindParam('usuario',$usuario);
	$cmd->bindParam('senha_hash',$senha_hash);
	$cmd->bindParam('id_nivel',$id_nivel);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->bindParam('data',$data);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosFuncionario($id_funcionario)
{
	global $pdo;
try{
	$sql = "SELECT 	f.nome AS nome,
					f.id_funcionario AS id_funcionario,
			       	f.cpf AS cpf,
			       	f.usuario AS usuario,
			       	nu.id_nivel AS id_nivel,
			       	nu.sub_nome AS nivel,
			       	f.telefone AS telefone,
			       	DATE_FORMAT(f.data,'%d/%m/%Y') as data

		FROM funcionarios f
		INNER JOIN niveis_usuarios nu
		ON f.id_nivel = nu.id_nivel WHERE f.id_funcionario = :id_funcionario";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_funcionario',$id_funcionario);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function alteraDadosFuncionario($nome, $telefone, $id_nivel, $id_funcionario, $id_restaurante)
{
	global $pdo;
try{
	$sql = "UPDATE funcionarios SET nome = :nome, telefone = :telefone, id_nivel = :id_nivel
			WHERE id_funcionario = :id_funcionario AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('telefone',$telefone);
	$cmd->bindParam('id_nivel',$id_nivel);
	$cmd->bindParam('id_funcionario',$id_funcionario);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function alteraSenhaFuncionario($id_funcionario, $senha, $id_restaurante)
{
	$senha = sha1($senha);
    $senha_hash = hash('sha512',$senha);

	global $pdo;
try{
	$sql = "UPDATE funcionarios SET senha = :senha_hash
			WHERE id_funcionario = :id_funcionario AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('senha_hash',$senha_hash);
	$cmd->bindParam('id_funcionario',$id_funcionario);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosProduto($id_produto)
{
	global $pdo;
try{
	$sql = "SELECT * FROM produtos WHERE id = :id_produto";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function alteraDadosProduto($nome, $id_categoria, $valor, $descricao, $id_produto)
{
	global $pdo;
try{
	$sql = "UPDATE produtos SET nome = :nome, id_categoria = :id_categoria, valor = :valor,
						descricao = :descricao WHERE id = :id_produto";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->bindParam('valor',$valor);
	$cmd->bindParam('descricao',$descricao);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaProdutoVendido($id_produto)
{
	global $pdo;
try{
	$sql = "SELECT p.id AS id,
	        p.nome AS nome,
	        ip.id_pedido AS id_pedido

		FROM itens_pedido ip
		INNER JOIN produtos p
		ON p.id = ip.id_produto WHERE p.id = :id_produto";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_produto',$id_produto);
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

function excluiProduto($id_produto,$id_restaurante)
{
	global $pdo;
try{
	$sql = "DELETE FROM produtos WHERE id = :id_produto
									AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_adicionais($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT a.nome AS nome,
				   a.id_adicional AS id_adicional,
			       a.valor AS valor,
			       c.nome AS categoria,
			       r.id_restaurante AS id_restaurante

			FROM adicionais a
			INNER JOIN categorias c
			ON a.id_categoria = c.id_categoria
			INNER JOIN restaurantes r
			ON r.id_restaurante = c.id_restaurante WHERE r.id_restaurante = :id_restaurante

			ORDER BY c.nome";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function cadastraAdicional($nome, $valor, $id_categoria)
{
	global $pdo;
try{
	$sql = "INSERT INTO adicionais (nome, valor, id_categoria)
				VALUES(:nome, :valor, :id_categoria)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('valor',$valor);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function lista_bordas($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT b.nome AS nome,
				   b.id_borda AS id_borda,
			       b.valor AS valor,
			       c.nome AS categoria,
			       r.id_restaurante AS id_restaurante

			FROM bordas b
			INNER JOIN categorias c
			ON b.id_categoria = c.id_categoria
			INNER JOIN restaurantes r
			ON r.id_restaurante = c.id_restaurante WHERE r.id_restaurante = :id_restaurante

			ORDER BY c.nome";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function cadastraBorda($nome, $valor, $id_categoria)
{
	global $pdo;
try{
	$sql = "INSERT INTO bordas (nome, valor, id_categoria)
				VALUES(:nome, :valor, :id_categoria)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('valor',$valor);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosBorda($id_borda)
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

function alteraDadosBorda($id_borda,$nome,$id_categoria,$valor)
{
	global $pdo;
try{
	$sql = "UPDATE bordas SET nome = :nome, valor = :valor, id_categoria = :id_categoria
				WHERE id_borda = :id_borda";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('valor',$valor);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->bindParam('id_borda',$id_borda);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosAdicional($id_adicional)
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

function alteraDadosAdicional($id_adicional,$nome,$id_categoria,$valor)
{
	global $pdo;
try{
	$sql = "UPDATE adicionais SET nome = :nome, valor = :valor, id_categoria = :id_categoria
				WHERE id_adicional = :id_adicional";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('valor',$valor);
	$cmd->bindParam('id_categoria',$id_categoria);
	$cmd->bindParam('id_adicional',$id_adicional);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraTotalLiquidoRecebido()
{
	global $pdo;
try{
	$sql = "SELECT 	SUM(vLiquido_Adm) AS total_liquido_adm,
					SUM(vTotal_Pago) AS total_recebido

				FROM tarifas WHERE status = 1";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraRecordDeLucro()
{
	global $pdo;
try{
	$sql = "SELECT 	SUM(vLiquido_Adm) AS liquido_adm,
       				DATE_FORMAT(data, '%d/%m/%Y') AS data

				FROM tarifas WHERE status = 1

					GROUP BY DATE_FORMAT(data, '%d/%m/%Y')
					  ORDER BY liquido_adm DESC
					  	LIMIT 1";

	$cmd = $pdo->prepare($sql);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraTotalLiquidoRecebidoR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT 	SUM(vLiquido_Adm) AS total_liquido_adm,
					SUM(vTotal_Pago) AS total_recebido

				FROM tarifas WHERE status = 1 AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraRecordDeLucroR($id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT 	SUM(vLiquido_Adm) AS liquido_adm,
       				DATE_FORMAT(data, '%d/%m/%Y') AS data

				FROM tarifas WHERE status = 1 AND id_restaurante = :id_restaurante

					GROUP BY DATE_FORMAT(data, '%d/%m/%Y')
					  ORDER BY liquido_adm DESC
					  	LIMIT 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function mostraDadosRelatorioVendas($data1,$data2,$id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT SUM(ip.qtd) AS qtd,
			      ip.id_produto AS id_produto,
			      p.data AS data,
			      pr.nome AS nome,
      			  SUM(ip.valor_unit*ip.qtd) as sub_total

			FROM itens_pedido ip
				INNER JOIN pedidos p
					ON ip.id_pedido = p.id_pedido
				INNER JOIN produtos pr
					ON ip.id_produto = pr.id

			WHERE p.data >= :data1 and p.data <= :data2
				AND p.id_restaurante = :id_restaurante AND p.id_status = 7

			GROUP BY id_produto
				ORDER BY qtd desc";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data1',$data1);
	$cmd->bindParam('data2',$data2);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetchAll();

}catch(PDOExceptiON $e){
 	 echo $e->getMessage();
	}
}

function mostraCategoriaProduto($id_produto)
{
	global $pdo;
try{
	$sql = "SELECT p.id as id_produto,
			       c.nome as categoria

			FROM produtos p
			INNER JOIN categorias c
			ON p.id_categoria = c.id_categoria WHERE id = :id_produto";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaTaxaEntregaRelatorio($data1, $data2, $id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT SUM(taxa_entrega) as taxa_entrega FROM pedidos
				WHERE data >= :data1 and data <= :data2
					AND id_restaurante = :id_restaurante AND id_status = 7";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data1',$data1);
	$cmd->bindParam('data2',$data2);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOExceptiON $e){
 	 echo $e->getMessage();
	}
}
function buscaTarifasRestauranteAdmin($data1, $data2, $id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT SUM(vTaxas_Restaurante) AS taxa_pgto FROM tarifas
				WHERE data >= :data1 AND data <= :data2
					AND id_restaurante = :id_restaurante AND status = 1";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('data1',$data1);
	$cmd->bindParam('data2',$data2);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaDadosAdicVendidos($data1, $data2, $id_produto)
{
	global $pdo;
try{
	$sql = "SELECT SUM(ip.qtd) AS qtd

      	FROM itens_pedido ip
		INNER JOIN pedidos p
		ON ip.id_pedido = p.id_pedido
      	WHERE data >= :data1 AND data <= :data2
      	AND id_produto = :id_produto AND ip.id_adicional > 0 AND p.id_status = 7";

    $cmd = $pdo->prepare($sql);
	$cmd->bindParam('data1',$data1);
	$cmd->bindParam('data2',$data2);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function buscaDadosBordaVendidos($data1, $data2, $id_produto)
{
	global $pdo;
try{
	$sql = "SELECT SUM(ip.qtd) AS qtd

      	FROM itens_pedido ip
		INNER JOIN pedidos p
		ON ip.id_pedido = p.id_pedido
      	WHERE data >= :data1 AND data <= :data2
      	AND id_produto = :id_produto AND ip.id_borda > 0 AND p.id_status = 7";

    $cmd = $pdo->prepare($sql);
	$cmd->bindParam('data1',$data1);
	$cmd->bindParam('data2',$data2);
	$cmd->bindParam('id_produto',$id_produto);
	$cmd->execute();

	return $cmd->fetch();

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}

function verificaCidadeEntrega($id_cidade_entrega, $id_restaurante)
{
	global $pdo;
try{
	$sql = "SELECT * FROM entregas_restaurantes WHERE id_cidade_entrega = :id_cidade_entrega
				AND id_restaurante = :id_restaurante";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('id_cidade_entrega',$id_cidade_entrega);
	$cmd->bindParam('id_restaurante',$id_restaurante);
	$cmd->execute();

	$cmd->fetch();

	if($cmd->rowCount() > 0){
		return false;
	} else {
		return true;
	}

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
}