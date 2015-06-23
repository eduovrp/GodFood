<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	   
    <link href="css/style_alternative.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
    
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
<script type="text/javascript">
        $(document).ready(function() {

            $('.footable').footable();

        });
 </script>
</head>
<body>
	
</body>
</html>

<?php
if(!isset($_SESSION))
{
    session_start();
}
	//recebemos nosso par?etro vindo do form
	$parametro = isset($_POST['pesquisaProduto']) ? $_POST['pesquisaProduto'] : null;
	$msg = "";
	//começamos a concatenar nossa tabela
	$msg .=" <table class='footable table table-stripped toggle-arrow-tiny' data-page-size='10'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th data-toggle='true'>Nome do Produto</th>";
	$msg .="			<th data-hide='phone'>Categoria</th>";
	$msg .="			<th class='desc' data-hide='all'>Descrição</th>";
	$msg .="			<th data-hide='phone'>Valor</th>";
	$msg .="			<th data-hide='phone'>Status</th>";
	$msg .="			<th data-sort-ignore='true'>Ação</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";

				//requerimos a classe de conexão
				require_once('conexao.php');

				$restaurante = $_SESSION['restaurante'];
					try {
						$pdo = new Conexao();
						$resultado = $pdo->select("SELECT p.nome AS nome_produto,
								 			p.descricao AS descricao,
								      		p.id AS codigo,
											p.valor AS valor_unit,
								     		c.nome AS categoria,
						          			p.id_restaurante AS cod_restaurante,
						          			p.status AS status

						FROM produtos p
					  	INNER JOIN categorias c
					  	ON p.id_categoria = c.id_categoria WHERE p.id_restaurante = $restaurante 
					  		AND p.nome LIKE '%$parametro%' OR c.nome LIKE '%$parametro%' 
					  			OR p.descricao LIKE '%$parametro%'

					  		ORDER BY c.nome ASC");

						$pdo->desconectar();

						}catch (PDOException $e){
							echo $e->getMessage();
						}
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td>".$res['nome_produto']."</td>";
	$msg .="					<td>".$res['categoria']."</td>";
	$msg .="					<td>".$res['descricao']."</td>";
	$msg .="					<td>R$ ".number_format($res['valor_unit'],2,",",".")."</td>";
if($res['status'] == 0){
	$msg .="					<td><span class='label label-danger'>Desativado</span></td>";
} else {
	$msg .="					<td><span class='label label-primary'>Ativado</span></td>";
}
	$msg .="					<td><a href='javascript:alterarDadosProduto(".$res['codigo'].")'><i class='fa fa-pencil-square-o fa-1x'></i> Editar</a></td>";
	$msg .="				</tr>";
							}
						}else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";

	$msg .="	 <tfoot>";
	$msg .="	 	<tr>";
	$msg .="	 		<td colspan='6'>";
	$msg .="	 			<ul class='pagination pull-right'></ul>";
	$msg .="	 		</td>";
	$msg .="	 	</tr>";
	$msg .="	 </tfoot>";

	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>

      <form action="alterarDadosProduto.php" method="POST" id="alterarDadosProduto">
        <input type="hidden" name="id_produto">
      </form>

    <script>
     function alterarDadosProduto(id_produto){
        f = document.getElementById('alterarDadosProduto');
        f.id_produto.value = id_produto;
        f.submit();
    }
</script>