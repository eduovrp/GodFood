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
	$parametro = isset($_POST['pesquisaBorda']) ? $_POST['pesquisaBorda'] : null;
	$msg = "";
	//começamos a concatenar nossa tabela
	$msg .=" <table class='footable table table-stripped toggle-arrow-tiny' data-page-size='10'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th data-toggle='true'>Nome do Ingrediente</th>";
	$msg .="			<th data-hide='phone'>Categoria</th>";
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
						$resultado = $pdo->select("SELECT b.nome AS nome,
								   b.id_borda AS id_borda,
							       b.valor AS valor,
							       c.nome AS categoria,
							       r.id_restaurante AS id_restaurante,
							       b.status AS status

							FROM bordas b
							INNER JOIN categorias c
							ON b.id_categoria = c.id_categoria
							INNER JOIN restaurantes r
							ON r.id_restaurante = c.id_restaurante WHERE r.id_restaurante = $restaurante
								AND b.nome LIKE '%$parametro%' OR c.nome LIKE '%$parametro%'

								ORDER BY c.nome");

						$pdo->desconectar();

						}catch (PDOException $e){
							echo $e->getMessage();
						}
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td class='bold'>".$res['nome']."</td>";
	$msg .="					<td>".$res['categoria']."</td>";
	$msg .="					<td>R$ ".number_format($res['valor'],2,",",".")."</td>";
if($res['status'] == 0){
	$msg .="					<td><span class='label label-danger'>Desativado</span></td>";
} else {
	$msg .="					<td><span class='label label-primary'>Ativado</span></td>";
}
	$msg .="					<td><a href='javascript:alterarDadosBorda(".$res['id_borda'].")'><i class='fa fa-pencil-square-o fa-1x'></i> Editar</a></td>";
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

      <form action="alterarDadosBorda.php" method="POST" id="alterarDadosBorda">
        <input type="hidden" name="id_borda">
      </form>

<script>
     function alterarDadosBorda(id_borda){
        f = document.getElementById('alterarDadosBorda');
        f.id_borda.value = id_borda;
        f.submit();
    }
</script>